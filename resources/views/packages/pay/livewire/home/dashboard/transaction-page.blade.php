<div>
    <x-parnas.loading wire:loading></x-parnas.loading>
    <div class="courses-dashboard">
        <div class="title-courses-dashboard">
            <i class="icon-circle"></i>
            <h2>تراکنش ها</h2>
        </div>
        <div class="list-courses-dashboard">
            <div class="header-courses">
                <span>شناسه پرداخت</span>
                <span>تاریخ</span>
                <span>مبلغ پرداختی</span>
                <span>وضعیت</span>
                <span></span>
            </div>
            @foreach($transactions as $transaction)
                <div class="body-courses">
                    <span>{{ isset($transaction->details['referenceId']) ? $transaction->details['referenceId'] : '-' }}</span>
                    <span>{{ jdate($transaction->created_at)->format('Y/m/d H:i') }}</span>
                    <span>{{ number_format($transaction->amount) }}</span>
                    <span>{{ $transaction->status->label }}</span>
                    <span></span>
                </div>
            @endforeach
            {{ $transactions->links() }}
        </div>
    </div>
</div>
