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
        this.getCa()
        this.getReserves();

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
            console.log(this.calenders)
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
}">
    <section class="section-content">
        <div class="container-fluid px-0">
            <div class="p-header col-xl-12 col-lg-12">
                <div class="backface-drop">
                    {{-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                        <path fill="#d7e2ea" fill-opacity="1"
                            d="M0,0L60,48C120,96,240,192,360,202.7C480,213,600,139,720,133.3C840,128,960,192,1080,192C1200,192,1320,128,1380,96L1440,64L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z">
                        </path>
                    </svg> --}}
                </div>
                <div class="title-head d-flex flex-column align-items-center">
                    <div style=" z-index:2;" class="d-flex">
                        <h1 class="text-white">اجاره ویلا</h1>
                        <span class="f-29 px-2">؛</span>
                        <span class="f-27 color-custom-base f-bold">شمال کشور</span>
                    </div>
                    <div class="btn-data col-xl-1 col-lg-1 col-5">
                        <button class="w-100 bg-custom-base text-white px-3 py-3">
                            اجاره ویلا
                        </button>
                    </div>
                </div>

                <div class="image w-100 d-flex justify-content-center">
                    <img class="w-100" src="{{ $thumbanil->first()?->url }}" alt="villa-image" />
                </div>
            </div>
        </div>
    </section>


    <section class="section-content">
        <div class="container">
            <div class="p-gallery">
                <div class="title pb-4">
                    <h3>ر{{ $residence->title }}</h3>
                </div>
                <div class="gallery-image d-flex flex-wrap justify-content-between align-items-start">
                    <div class="l-gallery">
                        <div class="image">
                            <img src="{{ $files->first()?->url }}" alt="" />
                        </div>
                    </div>
                    <div class="r-gallery d-flex flex-wrap justify-content-between">
                        @foreach ($files as $key => $file)
                            @if ($key <= 1)
                                <div class="image">
                                    <img src="{{ $file->url }}" alt="" />
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>



    <section class="section-content">
        <div class="container">
            <div class="card-headerdata box-data d-flex align-items-center">
                <div class="c-head d-flex justify-content-center col-xl-1 col-lg-1">
                    <span>معرفی</span>
                </div>
                <div class="c-head d-flex justify-content-center col-xl-1 col-lg-1">
                    <span>امکانات</span>
                </div>
                <div class="c-head d-flex justify-content-center col-xl-1 col-lg-1">
                    <span>قوانین</span>
                </div>
                <div class="c-head d-flex justify-content-center col-xl-1 col-lg-1">
                    <span>موقعیت مکانی</span>
                </div>
            </div>
            <div class="-data d-flex flex-wrap justify-content-between align-items-start">
                <div class="r-data">
                    <div class="box-data px-3 py-4 mb-4">
                        <div class="title d-flex align-items-center">
                            <svg id="Menu" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24">
                                <path id="Path_1022" data-name="Path 1022"
                                    d="M1,5.5a12.254,12.254,0,0,0,.2,2.553,2.311,2.311,0,0,0,.56,1.188,2.311,2.311,0,0,0,1.188.56A12.254,12.254,0,0,0,5.5,10a12.254,12.254,0,0,0,2.553-.2,2.311,2.311,0,0,0,1.188-.56A2.311,2.311,0,0,0,9.8,8.053,12.254,12.254,0,0,0,10,5.5a12.254,12.254,0,0,0-.2-2.553,2.311,2.311,0,0,0-.56-1.188A2.311,2.311,0,0,0,8.053,1.2,12.254,12.254,0,0,0,5.5,1a12.255,12.255,0,0,0-2.553.2,2.311,2.311,0,0,0-1.188.56A2.311,2.311,0,0,0,1.2,2.947,12.255,12.255,0,0,0,1,5.5Z"
                                    fill="none" stroke="#f47e43" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" />
                                <path id="Path_1023" data-name="Path 1023"
                                    d="M1,18.5a12.254,12.254,0,0,0,.2,2.553,2.312,2.312,0,0,0,.56,1.188,2.312,2.312,0,0,0,1.188.56A12.26,12.26,0,0,0,5.5,23a12.26,12.26,0,0,0,2.553-.2,2.312,2.312,0,0,0,1.188-.56,2.312,2.312,0,0,0,.56-1.188A12.254,12.254,0,0,0,10,18.5a12.254,12.254,0,0,0-.2-2.553,2.312,2.312,0,0,0-.56-1.188,2.312,2.312,0,0,0-1.188-.56A12.26,12.26,0,0,0,5.5,14a12.26,12.26,0,0,0-2.553.2,2.312,2.312,0,0,0-1.188.56,2.312,2.312,0,0,0-.56,1.188A12.254,12.254,0,0,0,1,18.5Z"
                                    fill="none" stroke="#f47e43" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" />
                                <path id="Path_1024" data-name="Path 1024"
                                    d="M14,5.5a12.26,12.26,0,0,0,.2,2.553,2.312,2.312,0,0,0,.56,1.188,2.312,2.312,0,0,0,1.188.56A12.254,12.254,0,0,0,18.5,10a12.254,12.254,0,0,0,2.553-.2,2.312,2.312,0,0,0,1.188-.56,2.312,2.312,0,0,0,.56-1.188A12.26,12.26,0,0,0,23,5.5a12.26,12.26,0,0,0-.2-2.553,2.312,2.312,0,0,0-.56-1.188,2.312,2.312,0,0,0-1.188-.56A12.254,12.254,0,0,0,18.5,1a12.254,12.254,0,0,0-2.553.2,2.312,2.312,0,0,0-1.188.56,2.312,2.312,0,0,0-.56,1.188A12.26,12.26,0,0,0,14,5.5Z"
                                    fill="none" stroke="#f47e43" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" />
                                <path id="Path_1025" data-name="Path 1025"
                                    d="M14,18.5a12.26,12.26,0,0,0,.2,2.553,2.312,2.312,0,0,0,.56,1.188,2.312,2.312,0,0,0,1.188.56A12.26,12.26,0,0,0,18.5,23a12.26,12.26,0,0,0,2.553-.2A1.942,1.942,0,0,0,22.8,21.053,12.26,12.26,0,0,0,23,18.5a12.26,12.26,0,0,0-.2-2.553,2.312,2.312,0,0,0-.56-1.188,2.312,2.312,0,0,0-1.188-.56A12.26,12.26,0,0,0,18.5,14a12.26,12.26,0,0,0-2.553.2,2.312,2.312,0,0,0-1.188.56,2.312,2.312,0,0,0-.56,1.188A12.26,12.26,0,0,0,14,18.5Z"
                                    fill="none" stroke="#f47e43" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" />
                            </svg>
                            <span class="f-20 f-bold ps-3">{{ $residence->title }}</span>
                        </div>
                        <div class="line-horizontal"></div>
                        <div class="paragraph px-3">
                            <p class="f-14">
                                {{ $residence->description }}
                            </p>
                        </div>
                    </div>
                    <div class="box-data px-3 py-4 mb-4">
                        <div class="title d-flex align-items-center">
                            <svg id="Menu" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24">
                                <path id="Path_1022" data-name="Path 1022"
                                    d="M1,5.5a12.254,12.254,0,0,0,.2,2.553,2.311,2.311,0,0,0,.56,1.188,2.311,2.311,0,0,0,1.188.56A12.254,12.254,0,0,0,5.5,10a12.254,12.254,0,0,0,2.553-.2,2.311,2.311,0,0,0,1.188-.56A2.311,2.311,0,0,0,9.8,8.053,12.254,12.254,0,0,0,10,5.5a12.254,12.254,0,0,0-.2-2.553,2.311,2.311,0,0,0-.56-1.188A2.311,2.311,0,0,0,8.053,1.2,12.254,12.254,0,0,0,5.5,1a12.255,12.255,0,0,0-2.553.2,2.311,2.311,0,0,0-1.188.56A2.311,2.311,0,0,0,1.2,2.947,12.255,12.255,0,0,0,1,5.5Z"
                                    fill="none" stroke="#f47e43" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" />
                                <path id="Path_1023" data-name="Path 1023"
                                    d="M1,18.5a12.254,12.254,0,0,0,.2,2.553,2.312,2.312,0,0,0,.56,1.188,2.312,2.312,0,0,0,1.188.56A12.26,12.26,0,0,0,5.5,23a12.26,12.26,0,0,0,2.553-.2,2.312,2.312,0,0,0,1.188-.56,2.312,2.312,0,0,0,.56-1.188A12.254,12.254,0,0,0,10,18.5a12.254,12.254,0,0,0-.2-2.553,2.312,2.312,0,0,0-.56-1.188,2.312,2.312,0,0,0-1.188-.56A12.26,12.26,0,0,0,5.5,14a12.26,12.26,0,0,0-2.553.2,2.312,2.312,0,0,0-1.188.56,2.312,2.312,0,0,0-.56,1.188A12.254,12.254,0,0,0,1,18.5Z"
                                    fill="none" stroke="#f47e43" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" />
                                <path id="Path_1024" data-name="Path 1024"
                                    d="M14,5.5a12.26,12.26,0,0,0,.2,2.553,2.312,2.312,0,0,0,.56,1.188,2.312,2.312,0,0,0,1.188.56A12.254,12.254,0,0,0,18.5,10a12.254,12.254,0,0,0,2.553-.2,2.312,2.312,0,0,0,1.188-.56,2.312,2.312,0,0,0,.56-1.188A12.26,12.26,0,0,0,23,5.5a12.26,12.26,0,0,0-.2-2.553,2.312,2.312,0,0,0-.56-1.188,2.312,2.312,0,0,0-1.188-.56A12.254,12.254,0,0,0,18.5,1a12.254,12.254,0,0,0-2.553.2,2.312,2.312,0,0,0-1.188.56,2.312,2.312,0,0,0-.56,1.188A12.26,12.26,0,0,0,14,5.5Z"
                                    fill="none" stroke="#f47e43" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" />
                                <path id="Path_1025" data-name="Path 1025"
                                    d="M14,18.5a12.26,12.26,0,0,0,.2,2.553,2.312,2.312,0,0,0,.56,1.188,2.312,2.312,0,0,0,1.188.56A12.26,12.26,0,0,0,18.5,23a12.26,12.26,0,0,0,2.553-.2A1.942,1.942,0,0,0,22.8,21.053,12.26,12.26,0,0,0,23,18.5a12.26,12.26,0,0,0-.2-2.553,2.312,2.312,0,0,0-.56-1.188,2.312,2.312,0,0,0-1.188-.56A12.26,12.26,0,0,0,18.5,14a12.26,12.26,0,0,0-2.553.2,2.312,2.312,0,0,0-1.188.56,2.312,2.312,0,0,0-.56,1.188A12.26,12.26,0,0,0,14,18.5Z"
                                    fill="none" stroke="#f47e43" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" />
                            </svg>
                            <span class="f-20 f-bold ps-3">امکانات</span>
                        </div>
                        <div class="line-horizontal"></div>
                        <div class="text-data d-flex flex-wrap align-items-center justify-contnet-start px-3">
                            @foreach ($residence->specifications['facilities'] as $faci)
                                <div class="c-data col-xl-3 col-lg-3 col-6 mb-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="31.567" height="31.18"
                                        viewBox="0 0 31.567 31.18">
                                        <g id="Modem" transform="translate(0.075 1)">
                                            <path id="Path_1042" data-name="Path 1042"
                                                d="M4,5.312a8.032,8.032,0,0,1,1.312-.75A6.137,6.137,0,0,1,7.937,4a6.137,6.137,0,0,1,2.624.562,8.032,8.032,0,0,1,1.312.75"
                                                transform="translate(1.249 -0.063)" fill="none" stroke="#347557"
                                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                                            <path id="Path_1043" data-name="Path 1043"
                                                d="M1,3.624a21.411,21.411,0,0,1,2.624-1.5A11.2,11.2,0,0,1,8.873,1a11.2,11.2,0,0,1,5.249,1.125,21.407,21.407,0,0,1,2.624,1.5"
                                                transform="translate(0.312 -1)" fill="none" stroke="#347557"
                                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                                            <path id="Path_1044" data-name="Path 1044"
                                                d="M9.185,6A1.312,1.312,0,0,1,10.5,7.312v7.9c1.53-.023,3.271-.023,5.249-.023s3.719,0,5.249.023V12.561a1.312,1.312,0,0,1,2.624,0v2.624c0,.033,0,.067,0,.1,6.3.3,7.877,1.525,7.877,6.461,0,4.163-1.119,5.684-5.249,6.24v.32a1.312,1.312,0,0,1-2.624,0v-.1c-2.074.1-4.661.1-7.873.1s-5.8,0-7.873-.1v.1a1.312,1.312,0,0,1-2.624,0v-.32C1.119,27.43,0,25.909,0,21.746c0-4.937,1.574-6.159,7.877-6.461q0-.049,0-.1V7.312A1.312,1.312,0,0,1,9.185,6Zm-6.2,18.362a6.235,6.235,0,0,1-.358-2.616,6.235,6.235,0,0,1,.358-2.616c.1-.2.251-.42.9-.651a15.3,15.3,0,0,1,4.058-.57c2-.1,4.535-.1,7.8-.1s5.8,0,7.8.1a15.3,15.3,0,0,1,4.058.57c.654.231.8.451.9.651a6.233,6.233,0,0,1,.358,2.616,6.233,6.233,0,0,1-.358,2.616c-.1.2-.25.42-.9.651a15.3,15.3,0,0,1-4.058.57c-2,.1-4.535.1-7.8.1s-5.8,0-7.8-.1a15.3,15.3,0,0,1-4.058-.57C3.233,24.781,3.083,24.562,2.982,24.362Z"
                                                transform="translate(0 0.561)" fill="#347557" fill-rule="evenodd" />
                                            <path id="Path_1045" data-name="Path 1045"
                                                d="M6.312,17a1.312,1.312,0,0,0,0,2.624H7.624a1.312,1.312,0,0,0,0-2.624Zm5.249,0a1.312,1.312,0,1,0,0,2.624h10.5a1.312,1.312,0,0,0,0-2.624Z"
                                                transform="translate(1.561 3.995)" fill="#347557" fill-rule="evenodd" />
                                        </g>
                                    </svg>
                                    <span
                                        class="f-15 ps-2">{{ collect(config('vila.facilities'))->firstWhere('id', $faci ?? 0)['title'] ?? 'ندارد' }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="box-data px-3 py-4 mb-4">
                        <div class="title d-flex align-items-center">
                            <svg id="Menu" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24">
                                <path id="Path_1022" data-name="Path 1022"
                                    d="M1,5.5a12.254,12.254,0,0,0,.2,2.553,2.311,2.311,0,0,0,.56,1.188,2.311,2.311,0,0,0,1.188.56A12.254,12.254,0,0,0,5.5,10a12.254,12.254,0,0,0,2.553-.2,2.311,2.311,0,0,0,1.188-.56A2.311,2.311,0,0,0,9.8,8.053,12.254,12.254,0,0,0,10,5.5a12.254,12.254,0,0,0-.2-2.553,2.311,2.311,0,0,0-.56-1.188A2.311,2.311,0,0,0,8.053,1.2,12.254,12.254,0,0,0,5.5,1a12.255,12.255,0,0,0-2.553.2,2.311,2.311,0,0,0-1.188.56A2.311,2.311,0,0,0,1.2,2.947,12.255,12.255,0,0,0,1,5.5Z"
                                    fill="none" stroke="#f47e43" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" />
                                <path id="Path_1023" data-name="Path 1023"
                                    d="M1,18.5a12.254,12.254,0,0,0,.2,2.553,2.312,2.312,0,0,0,.56,1.188,2.312,2.312,0,0,0,1.188.56A12.26,12.26,0,0,0,5.5,23a12.26,12.26,0,0,0,2.553-.2,2.312,2.312,0,0,0,1.188-.56,2.312,2.312,0,0,0,.56-1.188A12.254,12.254,0,0,0,10,18.5a12.254,12.254,0,0,0-.2-2.553,2.312,2.312,0,0,0-.56-1.188,2.312,2.312,0,0,0-1.188-.56A12.26,12.26,0,0,0,5.5,14a12.26,12.26,0,0,0-2.553.2,2.312,2.312,0,0,0-1.188.56,2.312,2.312,0,0,0-.56,1.188A12.254,12.254,0,0,0,1,18.5Z"
                                    fill="none" stroke="#f47e43" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" />
                                <path id="Path_1024" data-name="Path 1024"
                                    d="M14,5.5a12.26,12.26,0,0,0,.2,2.553,2.312,2.312,0,0,0,.56,1.188,2.312,2.312,0,0,0,1.188.56A12.254,12.254,0,0,0,18.5,10a12.254,12.254,0,0,0,2.553-.2,2.312,2.312,0,0,0,1.188-.56,2.312,2.312,0,0,0,.56-1.188A12.26,12.26,0,0,0,23,5.5a12.26,12.26,0,0,0-.2-2.553,2.312,2.312,0,0,0-.56-1.188,2.312,2.312,0,0,0-1.188-.56A12.254,12.254,0,0,0,18.5,1a12.254,12.254,0,0,0-2.553.2,2.312,2.312,0,0,0-1.188.56,2.312,2.312,0,0,0-.56,1.188A12.26,12.26,0,0,0,14,5.5Z"
                                    fill="none" stroke="#f47e43" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" />
                                <path id="Path_1025" data-name="Path 1025"
                                    d="M14,18.5a12.26,12.26,0,0,0,.2,2.553,2.312,2.312,0,0,0,.56,1.188,2.312,2.312,0,0,0,1.188.56A12.26,12.26,0,0,0,18.5,23a12.26,12.26,0,0,0,2.553-.2A1.942,1.942,0,0,0,22.8,21.053,12.26,12.26,0,0,0,23,18.5a12.26,12.26,0,0,0-.2-2.553,2.312,2.312,0,0,0-.56-1.188,2.312,2.312,0,0,0-1.188-.56A12.26,12.26,0,0,0,18.5,14a12.26,12.26,0,0,0-2.553.2,2.312,2.312,0,0,0-1.188.56,2.312,2.312,0,0,0-.56,1.188A12.26,12.26,0,0,0,14,18.5Z"
                                    fill="none" stroke="#f47e43" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" />
                            </svg>
                            <span class="f-20 f-bold ps-3">چشم انداز</span>
                        </div>
                        <div class="line-horizontal"></div>
                        <div class="text-data d-flex flex-wrap align-items-center justify-contnet-start px-3">
                            <div class="c-data col-xl-2 col-lg-2 col-6 mb-3">
                                <span
                                    class="f-12 {{ $this->getViewMode('کوهستان') ? 'active-data' : 'deactive-data' }}">کوهستان</span>
                            </div>
                            <div class="c-data col-xl-2 col-lg-2 col-6 mb-3">
                                <span
                                    class="f-12 {{ $this->getViewMode('جنگل') ? 'active-data' : 'deactive-data' }}">جنگل</span>
                            </div>
                            <div class="c-data col-xl-2 col-lg-2 col-6 mb-3">
                                <span
                                    class="f-12 {{ $this->getViewMode('دریا') ? 'active-data' : 'deactive-data' }}">دریا</span>
                            </div>
                            <div class="c-data col-xl-2 col-lg-2 col-6 mb-3">
                                <span
                                    class="f-12 {{ $this->getViewMode('کوهپایه') ? 'active-data' : 'deactive-data' }}">کوهپایه</span>
                            </div>
                            <div class="c-data col-xl-2 col-lg-2 col-6 mb-3">
                                <span
                                    class="f-12 {{ $this->getViewMode('دشت') ? 'active-data' : 'deactive-data' }}">دشت</span>
                            </div>
                        </div>
                    </div>
                    <div class="box-data px-3 py-4 mb-4">
                        <div class="title d-flex align-items-center">
                            <svg id="Menu" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24">
                                <path id="Path_1022" data-name="Path 1022"
                                    d="M1,5.5a12.254,12.254,0,0,0,.2,2.553,2.311,2.311,0,0,0,.56,1.188,2.311,2.311,0,0,0,1.188.56A12.254,12.254,0,0,0,5.5,10a12.254,12.254,0,0,0,2.553-.2,2.311,2.311,0,0,0,1.188-.56A2.311,2.311,0,0,0,9.8,8.053,12.254,12.254,0,0,0,10,5.5a12.254,12.254,0,0,0-.2-2.553,2.311,2.311,0,0,0-.56-1.188A2.311,2.311,0,0,0,8.053,1.2,12.254,12.254,0,0,0,5.5,1a12.255,12.255,0,0,0-2.553.2,2.311,2.311,0,0,0-1.188.56A2.311,2.311,0,0,0,1.2,2.947,12.255,12.255,0,0,0,1,5.5Z"
                                    fill="none" stroke="#f47e43" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" />
                                <path id="Path_1023" data-name="Path 1023"
                                    d="M1,18.5a12.254,12.254,0,0,0,.2,2.553,2.312,2.312,0,0,0,.56,1.188,2.312,2.312,0,0,0,1.188.56A12.26,12.26,0,0,0,5.5,23a12.26,12.26,0,0,0,2.553-.2,2.312,2.312,0,0,0,1.188-.56,2.312,2.312,0,0,0,.56-1.188A12.254,12.254,0,0,0,10,18.5a12.254,12.254,0,0,0-.2-2.553,2.312,2.312,0,0,0-.56-1.188,2.312,2.312,0,0,0-1.188-.56A12.26,12.26,0,0,0,5.5,14a12.26,12.26,0,0,0-2.553.2,2.312,2.312,0,0,0-1.188.56,2.312,2.312,0,0,0-.56,1.188A12.254,12.254,0,0,0,1,18.5Z"
                                    fill="none" stroke="#f47e43" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" />
                                <path id="Path_1024" data-name="Path 1024"
                                    d="M14,5.5a12.26,12.26,0,0,0,.2,2.553,2.312,2.312,0,0,0,.56,1.188,2.312,2.312,0,0,0,1.188.56A12.254,12.254,0,0,0,18.5,10a12.254,12.254,0,0,0,2.553-.2,2.312,2.312,0,0,0,1.188-.56,2.312,2.312,0,0,0,.56-1.188A12.26,12.26,0,0,0,23,5.5a12.26,12.26,0,0,0-.2-2.553,2.312,2.312,0,0,0-.56-1.188,2.312,2.312,0,0,0-1.188-.56A12.254,12.254,0,0,0,18.5,1a12.254,12.254,0,0,0-2.553.2,2.312,2.312,0,0,0-1.188.56,2.312,2.312,0,0,0-.56,1.188A12.26,12.26,0,0,0,14,5.5Z"
                                    fill="none" stroke="#f47e43" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" />
                                <path id="Path_1025" data-name="Path 1025"
                                    d="M14,18.5a12.26,12.26,0,0,0,.2,2.553,2.312,2.312,0,0,0,.56,1.188,2.312,2.312,0,0,0,1.188.56A12.26,12.26,0,0,0,18.5,23a12.26,12.26,0,0,0,2.553-.2A1.942,1.942,0,0,0,22.8,21.053,12.26,12.26,0,0,0,23,18.5a12.26,12.26,0,0,0-.2-2.553,2.312,2.312,0,0,0-.56-1.188,2.312,2.312,0,0,0-1.188-.56A12.26,12.26,0,0,0,18.5,14a12.26,12.26,0,0,0-2.553.2,2.312,2.312,0,0,0-1.188.56,2.312,2.312,0,0,0-.56,1.188A12.26,12.26,0,0,0,14,18.5Z"
                                    fill="none" stroke="#f47e43" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" />
                            </svg>
                            <span class="f-20 f-bold ps-3">اطلاعات</span>
                        </div>
                        <div class="line-horizontal"></div>
                        <div class="text-data d-flex flex-wrap align-items-center justify-contnet-start px-3">
                            <div class="c-data col-xl-4 col-lg-4 col-12 mb-3">
                                <span class="f-15 ps-2 f-bold">مساحت زمین:</span>
                                <span class="f-15 ps-2">{{ $residence->land_area }}</span>
                            </div>
                            <div class="c-data col-xl-4 col-lg-4 col-12 mb-3">
                                <span class="f-15 ps-2 f-bold">نوع ساختمان:</span>
                                <span
                                    class="f-15 ps-2">{{ collect(config('vila.types'))->firstWhere('id', $residence->specifications['type'] ?? 0)['title'] ?? 'ندارد' }}</span>
                            </div>
                            <div class="c-data col-xl-4 col-lg-4 col-12 mb-3">
                                <span class="f-15 ps-2 f-bold">تعداد اتاق:</span>
                                <span class="f-15 ps-2">{{ $residence->room_count }}</span>
                            </div>
                            <div class="c-data col-xl-4 col-lg-4 col-12 mb-3">
                                <span class="f-15 ps-2 f-bold">مساحت بنا:</span>
                                <span class="f-15 ps-2">{{ $residence->building_area }}</span>
                            </div>
                            <div class="c-data col-xl-4 col-lg-4 col-12 mb-3">
                                <span class="f-15 ps-2 f-bold">ظرفیت:</span>
                                <span class="f-15 ps-2">{{ $residence->capacity }}</span>
                            </div>
                            <div class="c-data col-xl-4 col-lg-4 col-12 mb-3">
                                <span class="f-15 ps-2 f-bold">حداکثر ظرفیت:</span>
                                <span class="f-15 ps-2">{{ $residence->maxCapacity }}</span>
                            </div>
                            <div class="c-data col-xl-4 col-lg-4 col-12 mb-3">
                                <span class="f-15 ps-2 f-bold">تعداد تشک:</span>
                                <span class="f-15 ps-2">{{ $residence->mattress }}</span>
                            </div>
                            <div class="c-data col-xl-4 col-lg-4 col-12 mb-3">
                                <span class="f-15 ps-2 f-bold">تخت ۱ نفره:</span>
                                <span class="f-15 ps-2">{{ $residence->singleBed }}</span>
                            </div>
                            <div class="c-data col-xl-4 col-lg-4 col-12 mb-3">
                                <span class="f-15 ps-2 f-bold">تخت ۲ نفره:</span>
                                <span class="f-15 ps-2">{{ $residence->twinBed }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="box-data px-3 py-4 mb-4">
                        <div class="title d-flex align-items-center">
                            <svg id="Menu" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24">
                                <path id="Path_1022" data-name="Path 1022"
                                    d="M1,5.5a12.254,12.254,0,0,0,.2,2.553,2.311,2.311,0,0,0,.56,1.188,2.311,2.311,0,0,0,1.188.56A12.254,12.254,0,0,0,5.5,10a12.254,12.254,0,0,0,2.553-.2,2.311,2.311,0,0,0,1.188-.56A2.311,2.311,0,0,0,9.8,8.053,12.254,12.254,0,0,0,10,5.5a12.254,12.254,0,0,0-.2-2.553,2.311,2.311,0,0,0-.56-1.188A2.311,2.311,0,0,0,8.053,1.2,12.254,12.254,0,0,0,5.5,1a12.255,12.255,0,0,0-2.553.2,2.311,2.311,0,0,0-1.188.56A2.311,2.311,0,0,0,1.2,2.947,12.255,12.255,0,0,0,1,5.5Z"
                                    fill="none" stroke="#f47e43" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" />
                                <path id="Path_1023" data-name="Path 1023"
                                    d="M1,18.5a12.254,12.254,0,0,0,.2,2.553,2.312,2.312,0,0,0,.56,1.188,2.312,2.312,0,0,0,1.188.56A12.26,12.26,0,0,0,5.5,23a12.26,12.26,0,0,0,2.553-.2,2.312,2.312,0,0,0,1.188-.56,2.312,2.312,0,0,0,.56-1.188A12.254,12.254,0,0,0,10,18.5a12.254,12.254,0,0,0-.2-2.553,2.312,2.312,0,0,0-.56-1.188,2.312,2.312,0,0,0-1.188-.56A12.26,12.26,0,0,0,5.5,14a12.26,12.26,0,0,0-2.553.2,2.312,2.312,0,0,0-1.188.56,2.312,2.312,0,0,0-.56,1.188A12.254,12.254,0,0,0,1,18.5Z"
                                    fill="none" stroke="#f47e43" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" />
                                <path id="Path_1024" data-name="Path 1024"
                                    d="M14,5.5a12.26,12.26,0,0,0,.2,2.553,2.312,2.312,0,0,0,.56,1.188,2.312,2.312,0,0,0,1.188.56A12.254,12.254,0,0,0,18.5,10a12.254,12.254,0,0,0,2.553-.2,2.312,2.312,0,0,0,1.188-.56,2.312,2.312,0,0,0,.56-1.188A12.26,12.26,0,0,0,23,5.5a12.26,12.26,0,0,0-.2-2.553,2.312,2.312,0,0,0-.56-1.188,2.312,2.312,0,0,0-1.188-.56A12.254,12.254,0,0,0,18.5,1a12.254,12.254,0,0,0-2.553.2,2.312,2.312,0,0,0-1.188.56,2.312,2.312,0,0,0-.56,1.188A12.26,12.26,0,0,0,14,5.5Z"
                                    fill="none" stroke="#f47e43" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" />
                                <path id="Path_1025" data-name="Path 1025"
                                    d="M14,18.5a12.26,12.26,0,0,0,.2,2.553,2.312,2.312,0,0,0,.56,1.188,2.312,2.312,0,0,0,1.188.56A12.26,12.26,0,0,0,18.5,23a12.26,12.26,0,0,0,2.553-.2A1.942,1.942,0,0,0,22.8,21.053,12.26,12.26,0,0,0,23,18.5a12.26,12.26,0,0,0-.2-2.553,2.312,2.312,0,0,0-.56-1.188,2.312,2.312,0,0,0-1.188-.56A12.26,12.26,0,0,0,18.5,14a12.26,12.26,0,0,0-2.553.2,2.312,2.312,0,0,0-1.188.56,2.312,2.312,0,0,0-.56,1.188A12.26,12.26,0,0,0,14,18.5Z"
                                    fill="none" stroke="#f47e43" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" />
                            </svg>
                            <span class="f-20 f-bold ps-3">قوانین</span>
                        </div>
                        <div class="line-horizontal"></div>
                        <div class="paragraph px-3">
                            <p class="f-14">
                                {{ $residence->rules['text'] ?? '' }}

                            </p>
                        </div>
                    </div>
                    <div class="box-data px-3 py-4 mb-1">
                        <div class="title d-flex align-items-center">
                            <svg id="Menu" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24">
                                <path id="Path_1022" data-name="Path 1022"
                                    d="M1,5.5a12.254,12.254,0,0,0,.2,2.553,2.311,2.311,0,0,0,.56,1.188,2.311,2.311,0,0,0,1.188.56A12.254,12.254,0,0,0,5.5,10a12.254,12.254,0,0,0,2.553-.2,2.311,2.311,0,0,0,1.188-.56A2.311,2.311,0,0,0,9.8,8.053,12.254,12.254,0,0,0,10,5.5a12.254,12.254,0,0,0-.2-2.553,2.311,2.311,0,0,0-.56-1.188A2.311,2.311,0,0,0,8.053,1.2,12.254,12.254,0,0,0,5.5,1a12.255,12.255,0,0,0-2.553.2,2.311,2.311,0,0,0-1.188.56A2.311,2.311,0,0,0,1.2,2.947,12.255,12.255,0,0,0,1,5.5Z"
                                    fill="none" stroke="#f47e43" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" />
                                <path id="Path_1023" data-name="Path 1023"
                                    d="M1,18.5a12.254,12.254,0,0,0,.2,2.553,2.312,2.312,0,0,0,.56,1.188,2.312,2.312,0,0,0,1.188.56A12.26,12.26,0,0,0,5.5,23a12.26,12.26,0,0,0,2.553-.2,2.312,2.312,0,0,0,1.188-.56,2.312,2.312,0,0,0,.56-1.188A12.254,12.254,0,0,0,10,18.5a12.254,12.254,0,0,0-.2-2.553,2.312,2.312,0,0,0-.56-1.188,2.312,2.312,0,0,0-1.188-.56A12.26,12.26,0,0,0,5.5,14a12.26,12.26,0,0,0-2.553.2,2.312,2.312,0,0,0-1.188.56,2.312,2.312,0,0,0-.56,1.188A12.254,12.254,0,0,0,1,18.5Z"
                                    fill="none" stroke="#f47e43" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" />
                                <path id="Path_1024" data-name="Path 1024"
                                    d="M14,5.5a12.26,12.26,0,0,0,.2,2.553,2.312,2.312,0,0,0,.56,1.188,2.312,2.312,0,0,0,1.188.56A12.254,12.254,0,0,0,18.5,10a12.254,12.254,0,0,0,2.553-.2,2.312,2.312,0,0,0,1.188-.56,2.312,2.312,0,0,0,.56-1.188A12.26,12.26,0,0,0,23,5.5a12.26,12.26,0,0,0-.2-2.553,2.312,2.312,0,0,0-.56-1.188,2.312,2.312,0,0,0-1.188-.56A12.254,12.254,0,0,0,18.5,1a12.254,12.254,0,0,0-2.553.2,2.312,2.312,0,0,0-1.188.56,2.312,2.312,0,0,0-.56,1.188A12.26,12.26,0,0,0,14,5.5Z"
                                    fill="none" stroke="#f47e43" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" />
                                <path id="Path_1025" data-name="Path 1025"
                                    d="M14,18.5a12.26,12.26,0,0,0,.2,2.553,2.312,2.312,0,0,0,.56,1.188,2.312,2.312,0,0,0,1.188.56A12.26,12.26,0,0,0,18.5,23a12.26,12.26,0,0,0,2.553-.2A1.942,1.942,0,0,0,22.8,21.053,12.26,12.26,0,0,0,23,18.5a12.26,12.26,0,0,0-.2-2.553,2.312,2.312,0,0,0-.56-1.188,2.312,2.312,0,0,0-1.188-.56A12.26,12.26,0,0,0,18.5,14a12.26,12.26,0,0,0-2.553.2,2.312,2.312,0,0,0-1.188.56,2.312,2.312,0,0,0-.56,1.188A12.26,12.26,0,0,0,14,18.5Z"
                                    fill="none" stroke="#f47e43" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" />
                            </svg>
                            <span class="f-20 f-bold ps-3">موقعیت</span>
                        </div>
                        <div class="line-horizontal"></div>
                        <div class="paragraph px-3">
                            <p class="f-14">
                                نقشه به زودی
                            </p>
                        </div>
                    </div>
                </div>
                <div class="l-data box-data px-2 pt-2 pb-5" @send-data.window="getDates">
                    <div class="box-data">
                        <div class="title pt-2">
                            {{-- <span class="f-15 f-bold">رزرو اقامتگاه</span> --}}
                            <div class="calenders mt-2" x-show="step === 1">
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
                                                            'date-reserved': x.data[x.data.length - 1].isReserved,
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
                                    <strong class="span-price-day">روز خروج</strong>
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
    </section>
</div>
