<div x-data="{
    calenders: @entangle('calenderData'),
    month: @entangle('currentMonth'),
    year: @entangle('currentYear'),
    dayIn: null,
    step: @entangle('step'),
    dayOut: null,
    isLoading: false,
    reserves: [],
    datesSelected: @entangle('datesSelected'),
    init() {
        this.getReserves();
        this.getCa()
    },
    nextStep() {
        if (this.datesSelected.length > 0) {
            this.step = 2;
        } else {
            alert('لطفا ابتدا روزهای خود را انتخاب کنید');
        }
    },
    previoesStep() {
        this.step = 1
    },
    getBetweenDatesSelected() {
        $wire.getDates(this.dayIn, this.dayOut).then(result => {
            this.datesSelected = JSON.parse(result);
            this.checkReservedInDates();
        });
    },
    checkReservedInDates() {
        if (this.dayOut < this.dayIn) {
            alert('تاریخ انتخابی نامعتبر است.');
            this.dayIn = null;
            this.dayOut = null;
        } else {
            for (let i = 0; i <= this.datesSelected.length; i++) {
                if (this.checkIsReserve(this.datesSelected[i])) {
                    this.dayOut = this.datesSelected[i];
                    alert('بین روزهای انتخابی شما روز غیرقابل رزرو وجود دارد.')
                    break;
                }
            }
            $wire.getDates(this.dayIn, this.dayOut).then(result => {
                this.datesSelected = JSON.parse(result);
            });
        }
    },
    getReserves() {
        $wire.getAllReservations().then(result => {
            this.reserves = result;
        })
    },
    getCa() {
        this.isLoading = true;
        $wire.getCalender($wire.calendarRequest).then(result => {
            this.calenders = JSON.parse(result);
            this.month = this.calenders.month;
            this.year = this.calenders.year;
            this.isLoading = false;
        })
    },
    checkIsReserve(date) {
        return this.reserves.includes(date);
    },
    itemClicked(data) {
        $wire.itemClicked(JSON.stringify(data))
    },
    nextMonth() {
        $wire.nextMonth().then(result => this.getCa())
    },
    previousMonth() {
        $wire.previousMonth().then(result => this.getCa())
    },
    onItemClicked(dateItem = null) {
        if (dateItem) {
            this.datesSelected = [];
            if (!this.dayIn && !this.dayOut) {
                if (this.checkIsReserve(dateItem)) {
                    alert('این تاریخ رزرو شده است');
                } else {
                    this.dayIn = dateItem
                }


            } else if (this.dayIn && !this.dayOut) {
                if (dateItem == this.dayIn) {
                    this.dayIn = null;
                    this.dayOut = null;
                } else {
                    this.dayOut = dateItem;
                    this.getBetweenDatesSelected();
                }
            } else {
                if (this.checkIsReserve(dateItem)) {
                    alert('این تاریخ رزرو شده است');
                    this.dayIn = null;
                    this.dayOut = null;
                } else {
                    this.dayIn = dateItem;
                    this.dayOut = null;
                }

            }
        } else {
            alert('امکان رزرو در این تاریخ وجود ندارد.');
        }
    },

    getDates(e) {
        this.calenders = JSON.parse(e.detail);
    },
    isItemExistToSelected(item) {
        return this.datesSelected.filter(x => x === item.dateEn)
    },
    findListItemIndex(item) {
        return this.calenders.dates.findIndex(x => x.dateEn === item.dateEn);
    },
    getIsDaysGone(dateItem) {
        return dateItem.status === 'Disabled' || dateItem.status === 'Hidden'
    }
}" @send-data.window="getDates">
    <!--? section 1 -->



    <section class="vila">
        <div class="prs-responsive">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 m-auto-x parent-vila">
                        <div class="right-box">
                            <div class="gallery">
                                <div class="right-gallery">
                                    <img src="{{ $files->first()?->url }}" alt="">
                                </div>
                                <div class="left-gallery">
                                    @foreach ($files as $key => $file)
                                        @if ($key <= 1)
                                            <img src="{{ $file->url }}" alt="">
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            <div class="s-vila">
                                <div class="title-vila">
                                    <div class="label-vila">
                                        <h2>{{ $residence->title }}(کد:{{ $residence->id }})</h2>
                                    </div>
                                    <div class="city-vila">
                                        <label for="">
                                            {{ isset($city->first()->title) }} -
                                            {{ isset($province->first()->title) }}
                                        </label>
                                    </div>
                                </div>
                                <div class="description-vila">
                                    <span>توضیحات :</span>
                                    <p>{{ $residence->description }}
                                    </p>
                                </div>
                            </div>

                            <div class="box-details col-xl-12 col-lg-12 col-12 d-flex flex-wrap">
                                <div class="item col-xl-3 col-lg-3 col-6 d-flex align-items-center">
                                    <label for="">مساحت زمین:</label>
                                    <span class="f-12">{{ $residence->land_area }}</span>
                                </div>
                                <div class="item col-xl-3 col-lg-3 col-6 d-flex align-items-center">
                                    <label for="">نوع ساختمان:</label>
                                    <span class="f-12">{{ collect(config('vila.types'))->firstWhere('id', $residence->specifications['type'] ?? 0)['title'] ?? 'ندارد' }}</span>
                                </div>

                                <div class="item col-xl-3 col-lg-3 col-6 d-flex align-items-center">
                                    <label for="">تعداد اتاق:</label>
                                    <span class="f-12">{{ $residence->room_count }}</span>
                                </div>
                                <div class="item col-xl-3 col-lg-3 col-6 d-flex align-items-center">
                                    <label for="">مساحت بنا:</label>
                                    <span class="f-12">{{ $residence->building_area }}</span>
                                </div>
                                <div class="item col-xl-3 col-lg-3 col-6 d-flex align-items-center">
                                    <label for="">ظرفیت:</label>
                                    <span class="f-12">{{ $residence->capacity }}</span>
                                </div>
                                <div class="item col-xl-3 col-lg-3 col-6 d-flex align-items-center">
                                    <label for="">حداکثر ظرفیت:</label>
                                    <span class="f-12">{{ $residence->maxCapacity }}</span>
                                </div>
                                <div class="item col-xl-3 col-lg-3 col-6 d-flex align-items-center">
                                    <label for="">تعداد تشک:</label>
                                    <span class="f-12">{{ $residence->mattress }}</span>
                                </div>
                                <div class="item col-xl-3 col-lg-3 col-6 d-flex align-items-center">
                                    <label for="">تخت ۱ نفره:</label>
                                    <span class="f-12">{{ $residence->singleBed }}</span>
                                </div>
                                <div class="item col-xl-3 col-lg-3 col-6 d-flex align-items-center">
                                    <label for="">تخت ۲ نفره:</label>
                                    <span class="f-12">{{ $residence->twinBed }}</span>
                                </div>
                            </div>
                            <div style="flex-direction:column!important" class="box-details d-flex align-items-start justify-content-start mt-2">
                                <div class="title-view">
                                    <h5>چشم انداز</h5>
                                </div>
    <div class="d-flex justify-content-start view-content col-lg-12">
        <div class=" item-second col-xl-2 col-lg-2 col-6 ps-3">
            <i class="icon-circle"></i>
            <span class="f-12 {{ $this->getViewMode('کوهستان') ?  'active-data' : 'deactive-data' }}">کوهستان</span>
        </div>
        <div class="item-second col-xl-2 col-lg-2 col-6 ps-3">
            {{-- <i class="fa fa-bed"></i> --}}
            <span class="f-12 {{ $this->getViewMode('جنگل') ?  'active-data' : 'deactive-data' }}"">جنگل</span>
        </div>
        <div class="item-second col-xl-2 col-lg-2 col-6 ps-3">
            {{-- <i class="fa fa-bed"></i> --}}
            <span class="f-12 {{ $this->getViewMode('دریا') ?  'active-data' : 'deactive-data' }}"">دریا</span>
        </div>
        <div class="item-second col-xl-2 col-lg-2 col-6 ps-3">
            {{-- <i class="fa fa-bed"></i> --}}
            <span class="f-12 {{ $this->getViewMode('کوهپایه') ?  'active-data' : 'deactive-data' }}"">کوهپایه</span>
        </div>
        <div class="item-second col-xl-2 col-lg-2 col-6 ps-3">
            {{-- <i class="fa fa-bed"></i> --}}
            <span class="f-12 {{ $this->getViewMode('دشت') ?  'active-data' : 'deactive-data' }}"">دشت</span>
        </div>
    </div>
                            </div>

                            {{-- collect(config('vila.views'))->firstWhere('id', $residence->specifications['view'] ?? 0)['title'] ?? 'ندارد'  --}}
                            <div class="box-details mt-2">
                                @foreach ($residence->specifications['facilities'] as $faci)
                                    <div class="item">
                                        <label
                                            for="">{{ collect(config('vila.facilities'))->firstWhere('id', $faci ?? 0)['title'] ?? 'ندارد' }}</label>
                                        {{-- <i class="{{collect(config('vila.facilities'))->firstWhere('id',$faci??0)['icon']??'ندارد'}}"></i> --}}
                                    </div>
                                @endforeach

                            </div>
                            {{-- <div class="map">
                                <iframe
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d12953.497785600752!2d51.538474434353056!3d35.74160024927906!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3f8e1d0522761f97%3A0x1698faeefccf4d06!2sEast%20Tehran%20Pars%2C%20District%204%2C%20Tehran%2C%20Tehran%20Province%2C%20Iran!5e0!3m2!1sen!2s!4v1649244509578!5m2!1sen!2s"
                                    style="border:0;" allowfullscreen="" loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div> --}}
                            @if ($residence->rules)
                                <div class="Rules mt-2">
                                    <div class="title-Rules">
                                        <h2>قوانین</h2>
                                    </div>
                                </div>
                                <span class="list-rules">
                                    {{ $residence->rules['text'] ?? '' }}
                                </span>
                            @endif
                        </div>
                        <div class="left-box">
                            {{-- @guest
                                <div class="fix-left-box">
                                    <button class="login-btn-reserve">
                                        <a href="/authenticate"> لطفا ابتدا وارد شوید</a>
                                    </button>
                                </div>
                            @endguest --}}

                            <div class="title-reserve-vila">
                                <h2>رزرو ویلا</h2>
                            </div>
                            <div class="calenders" x-show="step === 1">
                                <section>
                                    <div class="calender">
                                        <div class="loading" x-show="isLoading">
                                            <div>
                                                <div class="spinner-loading"></div>
                                                <h2 class="h2">صبرکنید ...</h2>
                                            </div>
                                        </div>
                                        <div class="header-calender">
                                            <div class="month-prev" @click="previousMonth()">
                                                <svg id="Outline" viewBox="0 0 24 24" width="22" height="22">
                                                    <path
                                                        d="M7,24a1,1,0,0,1-.71-.29,1,1,0,0,1,0-1.42l8.17-8.17a3,3,0,0,0,0-4.24L6.29,1.71A1,1,0,0,1,7.71.29l8.17,8.17a5,5,0,0,1,0,7.08L7.71,23.71A1,1,0,0,1,7,24Z" />
                                                </svg>
                                                <span class="text-month-prev">ماه قبل</span>
                                            </div>
                                            <div class="date-header">
                                                <strong>{{ $months->firstWhere('id', $currentMonth ?? 1)['text'] }}</strong>
                                                <strong class="years"> {{ $currentYear }}</strong>
                                            </div>
                                            <div class="month-next" @click="nextMonth()">
                                                <a class="text-month-next">ماه بعد</a>
                                                <svg id="Outline" viewBox="0 0 24 24" width="22" height="22">
                                                    <path
                                                        d="M7,24a1,1,0,0,1-.71-.29,1,1,0,0,1,0-1.42l8.17-8.17a3,3,0,0,0,0-4.24L6.29,1.71A1,1,0,0,1,7.71.29l8.17,8.17a5,5,0,0,1,0,7.08L7.71,23.71A1,1,0,0,1,7,24Z" />
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="body-calender">
                                            <div class="week-header">
                                                <label for="">ش</label>
                                                <label for="">ی</label>
                                                <label for="">د</label>
                                                <label for="">س </label>
                                                <label for="">چ </label>
                                                <label for="">پ </label>
                                                <label for="">ج</label>
                                            </div>
                                            <div class="week-body">

                                                <template x-for="(x , index) in calenders?.dates">

                                                    <div class="item-number-day"
                                                        :class="{
                                                            'date-selected': isItemExistToSelected(x).length > 0,
                                                            'date-dayIn': dayIn === x.dateEn,
                                                            'date-dayOut': dayOut === x.dateEn,
                                                            'date-reserved': x.data[x.data.length-1].isReserved,
                                                            'date-disabled': getIsDaysGone(x),
                                                            'not-set-price': (x.data.length === 0 || !x.data[x.data
                                                                    .length - 1]
                                                                .price) && !getIsDaysGone(x)
                                                        }"
                                                        @click="(getIsDaysGone(x) || x.data.length === 0 || x.data[x.data.length-1].isReserved) ? onItemClicked(null) :onItemClicked(x.dateEn)">
                                                        <template x-if="x.isToday">
                                                            <label class="active-day" for="">امروز</label>
                                                        </template>

                                                        {{-- <template x-if="x.data.length > 0 && x.data[x.data.length-1].isReserved && !getIsDaysGone(x)">
                                                            <label class="reserved" for="">رزرو</label>
                                                        </template> --}}
                                                        {{-- <template x-if="x.data.length > 0 && !x.data[x.data.length-1].isReserved && !getIsDaysGone(x)"> --}}
                                                        {{-- <label class="not-reserved" for="">رزرو نشده</label> --}}
                                                        {{-- </template> --}}

                                                        <template x-if="x.status !== 'Hidden'">
                                                            <h1 class="number"
                                                                :class="{ 'text-danger': x.isHolyDay }"
                                                                x-text="x.dateFa.split('-')[2]"></h1>
                                                        </template>

                                                        {{-- <small style="font-size: 12px">رزرو شده</small> --}}
                                                        <div class="price-day">
                                                            <template
                                                                x-if="x.data.length > 0 && x.data[x.data.length-1].price && !getIsDaysGone(x)  && !x.data[x.data.length-1].isReserved">

                                                                <span
                                                                    x-text="(x.data[x.data.length-1].price / 1000)"></span>
                                                            </template>
                                                            <template
                                                                x-if="(x.data.length === 0 || !x.data[x.data.length-1].price) && (x.status !== 'Disabled' && x.status !== 'Hidden')">
                                                                <p>بدون قیمت</p>
                                                            </template>
                                                        </div>
                                                        {{-- <template x-if="x.data.length > 0 && x.data[x.data.length-1].isReserved"> --}}

                                                        {{-- <span x-text="'رزرو شده'"></span> --}}
                                                        {{-- </template> --}}
                                                        {{-- <template x-if="x.data.length === 0 || !x.data[x.data.length-1].isReserved"> --}}

                                                        {{-- <small x-text="'رزرو نشده'"></small> --}}
                                                        {{-- </template> --}}
                                                        <template x-if="x.status === 'Disabled'">
                                                            <div class="disable-day">
                                                                <div class="linear-disable"></div>

                                                            </div>
                                                        </template>
                                                    </div>
                                                </template>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                            <div class="date-vila">
                                <div class="date-start">
                                    <span>تاریخ شروع</span>
                                    <span>{{ count($datesSelected) > 0 ? $this->getDateFA($datesSelected[0]) : '---' }}</span>
                                </div>
                                <div class="date-exit">
                                    <span>تاریخ خروج</span>
                                    <span>{{ count($datesSelected) > 0 ? $this->getDateFA($datesSelected[count($datesSelected) - 1]) : '---' }}</span>
                                </div>
                            </div>
                            <div class="day-selected">
                                <h2>روزهای انتخابی</h2>
                            </div>
                            @foreach ($datesSelected as $dateItem)
                                <div class="price-day selected-day-list">
                                    <span>{{ $this->getDateFA($dateItem) }}</span>
                                    @if ($loop->index === count($datesSelected) - 1)
                                        <strong  class="span-price-day">روز خروج</strong>
                                    @else
                                        {{-- @dd($this->getPrice($dateItem)) --}}
                                        <strong>{{ number_format($this->getPrice($dateItem)[count($this->getPrice($dateItem)) - 1]['price']) }}</strong>
                                    @endif
                                </div>
                            @endforeach
                            @if ($this->getTotalAdditionalPrice() > 0)
                                <div class="total-price">
                                    <span> هزینه نفر اضافه ({{ $additionalCount . 'نفر' }})</span>
                                    <strong>{{ number_format($this->getTotalAdditionalPrice()) }}</strong>
                                </div>
                            @endif
                            <div class="total-price">
                                <span>جمع کل</span>
                                <strong>{{ number_format($this->getTotalPrice()) }}</strong>
                            </div>
                            @if ($step === 2)
                                <form class="w-100 d-flex parent-form-info-villa">
                                    <div class="form-group">
                                        <label for="name">نام سرپرست</label>
                                        <input type="text" wire:model.defer="name" class="form-control" id="name">
                                    </div>
                                    <div class="form-group">
                                        <label for="family">نام خانوادگی سرپرست</label>
                                        <input type="text" wire:model.defer="family" class="form-control" id="family">
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">شماره همراه</label>
                                        <input type="text" wire:model.defer="phone" class="form-control" id="phone">
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">تعداد افراد</label>
                                        <select name="" wire:model="count">
                                            @foreach (range(1, $residence->maxCapacity) as $count)
                                                <option value="{{ $count }}">
                                                    {{ $count }} نفر
                                                    @if ($count > $residence->capacity && collect($residence->specifications)->has('additionalPrice'))
                                                        <span>(هر نفر اضافه
                                                            {{ number_format($residence->specifications['additionalPrice']) . 'تومان' }})</span>
                                                    @endif
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </form>
                            @endif

                            @if ($step === 1)

                                <button class="btn-reserve" wire:click="nextStep">
                                    ادامه
                                </button>
                            @else
                                @if (collect($residence->specifications)->has('paymentType') && $residence->specifications['paymentType'] === '2')
                                    <button class="btn-reserve" wire:click="pay">
                                        پرداخت
                                    </button>
                                @else
                                    <button class="btn-reserve" wire:click="submit">
                                        درخواست رزرو
                                    </button>
                                @endif
                                <button class="btn-reserve" @click="previoesStep()">
                                    ویرایش درخواست
                                </button>
                            @endif




                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



</div>
