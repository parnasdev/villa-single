<?php


namespace Packages\pay\src\Http\Controllers;


use App\Http\Controllers\Controller;
use Artesaos\SEOTools\Facades\SEOTools;
use Packages\order\src\Models\Order;
use Packages\pay\src\Models\Transaction;
use Packages\Villa\src\Models\ResidenceReserve;
use Shetabit\Multipay\Exceptions\InvalidPaymentException;
use Shetabit\Multipay\Exceptions\PurchaseFailedException;
use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment;

class PaymentController extends Controller
{

    public function callbackurl(ResidenceReserve $reserve)
    {
        $message = null;
        if ($reserve->status_id != getStatus('')) {
            try {
                $receipt = Payment::amount($reserve->totalPrice)->transactionId(request('Authority'))->verify();
                $transaction = Transaction::query()->where('resnumber', request('Authority'))->first();
                $transaction->update([
                    'exit_port_at' => now(),
                    'details' => [
                        'referenceId' => $receipt->getReferenceId()
                    ],
                    'status_id' => getStatus('successful'),
                ]);
                $reserve->update([
                    'status_id' => getStatus('')
                ]);
            } catch (InvalidPaymentException $exception) {
                $message = $exception->getMessage();
                $transaction = Transaction::query()->where('resnumber', request('Authority'))->first();
                $transaction->update([
                    'exit_port_at' => now(),
                    'status_id' => getStatus('unsuccessful'),
                ]);
            }
        } else {
            $transaction = Transaction::query()->where('resnumber', request('Authority'))->first();
        }

        SEOTools::metatags()->addMeta('robots' , 'noindex');

        return view('pay::home.verify', compact('transaction', 'reserve' , 'message'));
    }

    public function purchase(ResidenceReserve $reserve)
    {
        if ($reserve->status_id != getStatus('')) {
            return redirect('/');
        }

        $invoice = new Invoice();

        $invoice->amount($reserve->totalPrice);
        $payment = Payment::callbackUrl(route('pay.verify', ['reserve' => $reserve->id]));
        try {
            $payment->purchase(
                $invoice,
                function ($driver, $transactionId) use ($reserve) {
                    Transaction::query()->create([
                        'amount' => $reserve->totalPrice,
                        'resnumber' => $transactionId,
                        'enter_port_at' => now(),
                        'status_id' => getStatus(''),
                        'transactiontable_type' => get_class($reserve),
                        'transactiontable_id' => $reserve->id
                    ]);
                }
            );
        } catch (PurchaseFailedException $exception) {
            $message = $exception->getMessage();
            return redirect('/');
        }

        return $payment->pay()->render();
    }

}
