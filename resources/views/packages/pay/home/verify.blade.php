<x-parnas.layouts.verify-layout>
    <div class="verify">
        <section class="factor">
            <div class="responsive">
                <div class="container-fluid">
                    <div class="row">
                        @if($transaction->status_id == config('pay.enums.status.successful'))
                            <div class="col-md-11 m-auto parent-success">
                                <div class="top-item">
                                    <div class="patern"></div>
                                    <div
                                        class="box-details align-items-center justify-content-center d-flex flex-column">
                                        <div class="icon">
                                            <i class="icon-ok-1"></i>
                                        </div>
                                        <h3 class="title-factor">رزرو شما با موفقیت انجام شد</h3>
                                        <span
                                            class="span-verify">پرداخت با موفقیت انجام شد. رزرو شما با موفقیت ثبت شد</span>
                                        <div class="code-order">
                                            <h2 class="title-code-order">کد پرداخت :</h2>
                                            <h2 class="text-code-order">{{ isset($transaction->details['referenceId']) ? $transaction->details['referenceId'] : '' }}</h2>
                                        </div>
                                        <div class="info-order">
                                            <div class="date">
                                                <span class="title">تاریخ : </span>
                                                <span
                                                    class="text">{{ jdate($transaction->created_at)->format('Y-m-d') }}</span>
                                            </div>
                                            <div class="payment">
                                                <span class="title">روش پرداخت : </span>
                                                <span
                                                    class="text">پرداخت اینترنتی: </span>
                                            </div>
                                            <div class="price">
                                                <span class="title">قیمت نهایی : </span>
                                                <span
                                                    class="text">{{ number_format($transaction->amount) }} تومان</span>
                                            </div>
                                        </div>
                                        <div class="button-parent">
                                            <a class="btn-home" href="/">
                                                <i class="icon-circle"></i>
                                                <span>صفحه اصلی</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="col-md-11 m-auto parent-unsuccess">
                                <div class="top-item">
                                    <div class="patern"></div>
                                    <div
                                        class="box-details align-items-center justify-content-center d-flex flex-column">
                                        <div class="icon-unsuccess">
                                            <i class="icon-cancel-1"></i>
                                        </div>
                                        <h3 class="title-factor">متاسفانه رزرو شما لغو شد</h3>
                                        <span class="span-verify">چنانچه طی این فرایند مبلغی از حساب شما کسر شده است،طی 72 ساعت آینده به حساب شما باز خواهد گشت.</span>
                                        <div class="code-order">
                                            <h2 class="title-code-order">کد پرداخت :</h2>
                                            <h2 class="text-code-order">{{ isset($transaction->details['referenceId']) ? $transaction->details['referenceId'] : '' }}</h2>
                                        </div>
                                        <div class="info-order">
                                            <div class="date">
                                                <span class="title">تاریخ : </span>
                                                <span
                                                    class="text">{{ jdate($transaction->created_at)->format('Y-m-d') }}</span>
                                            </div>
                                            <div class="payment">
                                                <span class="title">روش پرداخت : </span>
                                                <span
                                                    class="text">پرداخت اینترنتی: </span>
                                            </div>
                                            <div class="price">
                                                <span class="title">قیمت نهایی : </span>
                                                <span
                                                    class="text">{{ number_format($transaction->amount) }} تومان</span>
                                            </div>
                                        </div>
                                        <div class="button-parent">
                                            <a class="btn-home" href="/">
                                                <i class="icon-circle"></i>
                                                <span>صفحه اصلی</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif


                    </div>
                </div>
            </div>
        </section>
    </div>
</x-parnas.layouts.verify-layout>
