<div>
    <section class="s-about-us-top">
        <div class="bg-dark-opacity"></div>
        <div class="prs-responsive">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-11 m-auto-x page-about-us-top">
                        <h1 class="title-fa">سبد خرید</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="s-about-us-bottom-1">
        <section class="h-100 h-custom" style="background-color: #eee;">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col">
                        <div class="card">
                            <div class="card-body p-4">
                                @if($carts->isNotEmpty())
                                    <div class="row">

                                        <div class="col-lg-7">
                                            <h5 class="mb-3"><a href="{{ route('courses.index') }}" class="text-body"><i
                                                        class="icon-right-open me-2"></i>ادامه خرید دوره</a></h5>
                                            <hr>
                                            @foreach($carts as $cart)
                                                <div class="card mb-3" x-data="{show : false}">
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between">
                                                            <div class="d-flex flex-row align-items-center">
                                                                <div>
                                                                    <img
                                                                        src="{{ $cart['post']->files()->where('type' , 1)->first()?->url }}"
                                                                        class="img-fluid rounded-3" alt="Shopping item"
                                                                        style="width: 65px;">
                                                                </div>
                                                                <div class="ms-3">
                                                                    <h5>{{ $cart['post']->title }}</h5>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex flex-row align-items-center">
                                                                @if((int)$cart['post']->options['offer_price'] > 0)
                                                                    <div style="width: 150px;">
                                                                        <del>{{ number_format($cart['post']->options['price']) }}</del>
                                                                        <h5 class="mb-0">
                                                                            {{ number_format($cart['post']->options['offer_price']) }}
                                                                            تومان
                                                                        </h5>
                                                                    </div>
                                                                @else
                                                                    <div style="width: 150px;">
                                                                        <h5 class="mb-0">
                                                                            {{ number_format($cart['post']->options['price']) }}
                                                                            تومان
                                                                        </h5>
                                                                    </div>
                                                                @endif
                                                                <a href="#" @click.prevent="show = !show"
                                                                   style="color: #cecece;"><i
                                                                        class="icon-trash"></i></a>
                                                            </div>
                                                        </div>
                                                        <div class="mt-4" style="display: none" x-show="show"
                                                             @click.outside="show = false"
                                                             x-transition:enter.duration.500ms
                                                             x-transition:leave.duration.400ms>
                                                            <div class="d-flex">
                                                                <div>
                                                                    <h5 class="mb-0">آیا از حذف
                                                                        دوره {{ $cart['post']->title }} از صفر مطمئن
                                                                        هستید؟</h5>
                                                                </div>
                                                                <a href="#" style="color: #cecece;"
                                                                   @click.prevent="$wire.deleteItem('{{ $cart['id'] }}')"><i
                                                                        class="icon-trash"></i></a>
                                                                <a href="#" @click.prevent="show = false"
                                                                   style="color: #cecece;"><i
                                                                        class="icon-reply"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="col-lg-5">

                                            <div class="card bg-primary text-white rounded-3">
                                                <div>
                                                    <button wire:click="changeType('online')">آنلاین</button>
                                                    @if(config('options.atmCart.active'))
                                                        <button wire:click="changeType('cart')">کارت به کارت</button>
                                                    @endif
                                                </div>
                                                <div class="card-body">
                                                    @if($type == 'online')
                                                        @foreach(config('options.ports') as $port)
                                                            <label>
                                                                <input type="radio" value="{{ $port }}"
                                                                       wire:model.lazy="portSelected">
                                                                {{ __('ports.'.$port) }}
                                                            </label>
                                                        @endforeach
                                                    @else
                                                        @foreach(config('options.atmCart.items') as $item)
                                                            <div class="d-flex justify-content-between">
                                                                <img width="50px" height="50px"
                                                                     src="{{ $item['bankInfo']['logo'] }}">
                                                                <p>{{ $item['cartNumber'] }}</p>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                    <div class="d-flex justify-content-between">
                                                        <p class="mb-2">مجموع قیمت</p>
                                                        <p class="mb-2">
                                                            {{ number_format($SumBasePrice) }}
                                                            تومان
                                                        </p>
                                                    </div>
                                                    {{--                                                    {{ dd($carts->pluck('post')) }}--}}
                                                    <div class="d-flex justify-content-between">
                                                        <p class="mb-2">مجموع تخفیفات</p>
                                                        @if($SumOfferPrice > 0)
                                                            <p class="mb-2">
                                                                {{ number_format($SumOfferPrice) }}
                                                                تومان
                                                            </p>
                                                        @else
                                                            <p class="mb-2">0</p>
                                                        @endif

                                                    </div>
                                                    <button type="button" class="btn btn-info btn-block btn-lg"
                                                            wire:click="pay" wire:loading.remove wire:target="pay">
                                                        <div class="d-flex justify-content-between">
                                                        <span>{{ number_format($SumBasePrice - $SumOfferPrice) }}
                                                         تومان</span>
                                                            <span> {{ $type == 'online' ? 'پرداخت' : 'ثبت نهایی' }} <i
                                                                    class="icon-left-open ml-2"></i></span>
                                                        </div>
                                                    </button>

                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                @else
                                    <p>سبد خرید خالی است.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
</div>
