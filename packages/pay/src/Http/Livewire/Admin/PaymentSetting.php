<?php


namespace Packages\pay\src\Http\Livewire\Admin;


use App\Models\Setting;

class PaymentSetting extends \Livewire\Component
{
    public array $setting = [];

    public array $banks = [];

    public function mount()
    {
        $setting = Setting::query()->whereIn('name', ['ports', 'atmCart'])->get();
        foreach ($setting as $item) {
            $this->setting[$item->name] = $item->value;
        }

        $this->banks = config('pay.enums.banks');
    }

    public function render()
    {
        $ports = [
            'fanavacard',
            'asanpardakht',
            'behpardakht',
            'digipay',
            'etebarino',
            'idpay',
            'irankish',
            'nextpay',
            'parsian',
            'pasargad',
            'payir',
            'paypal',
            'payping',
            'paystar',
            'poolam',
            'sadad',
            'saman',
            'sepehr',
            'walleta',
            'yekpay',
            'zarinpal',
            'zibal',
            'sepordeh'
        ];
        return view('pay::livewire.admin.payment-setting', compact('ports'));
    }

    public function submit()
    {
        foreach ($this->setting as $key => $setting) {
            Setting::query()->where('name', $key)->first()->update([
                'value' => $setting
            ]);
        }

        $this->dispatchBrowserEvent('toast-message', ['message' => 'تنظیمات اعمال شد.', 'icon' => 'success']);
    }
}
