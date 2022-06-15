<div x-data="{
    dayIn: null,
    step: @entangle('step'),
    dayOut: null,
    coll: false,
    init() {},
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
}">
    <section class="section-content">
        <div class="container-fluid px-0">
            <div class="p-header col-xl-12 col-lg-12">

                <div class="title-head d-flex flex-column align-items-center">
                    <div style=" z-index:2;" class="d-flex">
                        <h1 class="text-white">{{ $residence->title }}</h1>
                        <span class="f-29 px-2">؛</span>
                        <span
                            class="f-27 color-custom-base f-bold">{{ $residence->city()->first()?->title . ' , ' . $residence->province()->first()?->title }}</span>
                    </div>
                    <div class="btn-data col-xl-1 col-lg-1 col-5">
                        <button class="w-100 bg-custom-base text-white px-3 py-3" @click="window.scrollTo(1500,1500)">
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
                    <h3>{{ $residence->title }}</h3>
                </div>
                <div class="w-100" x-data="{ swiper: null }" x-init="swiper = new Swiper($refs.container, {
                    loop: false,
                    slidesPerView: 1,
                })">
                    <div class="swiper w-100" x-ref="container">
                        <div class="gallery-image swiper-wrapper">
                            @foreach ($files as $key => $file)
                                <div class="r-gallery swiper-slide">
                                    <div class="image">
                                        <img src="{{ $file->url }}" alt="" />
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- swiper next and prev -->
                    <button class="swiper-button-next" @click="swiper.slideNext()">
                    </button>
                    <button class="swiper-button-prev" @click="swiper.slidePrev()">
                    </button>
                </div>
            </div>
        </div>
    </section>



    <section class="section-content">
        <div class="container">
            <div class="card-headerdata box-data d-flex align-items-center" x-data="{ tabData: 'one' }">
                <a @click="tabData='four'" href="#data-one"
                    class="c-head d-flex justify-content-center col-xl-1 col-lg-1 active-data">
                    <span>معرفی</span>
                </a>
                <a @click="tabData='four'" href="#data-two"
                    class="c-head d-flex justify-content-center col-xl-1 col-lg-1">
                    <span>امکانات</span>
                </a>
                <a @click="tabData='four'" href="#data-three"
                    class="c-head d-flex justify-content-center col-xl-1 col-lg-1">
                    <span>قوانین</span>
                </a>
                <a @click="tabData='four'" href="#data-four"
                    class="c-head d-flex justify-content-center col-xl-1 col-lg-1">
                    <span>موقعیت مکانی</span>
                </a>
            </div>
            <div class="-data d-flex flex-wrap justify-content-between align-items-start">
                <div class="r-data">
                    <div class="box-data px-3 py-4 mb-4" id="data-one">
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
                            <span class="f-20 f-bold ps-3">رزرو</span>
                        </div>
                        <div class="line-horizontal"></div>
                        <div class="multiple-calender">
                            <x-parnas.inputs.home-date-picker :data="$this->calendarRequest"
                                minDate="{{ jdate()->format('Y/m/d') }}" />
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
                    <div class="box-data px-3 py-4 mb-4" id="data-two">
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
                    <div class="box-data px-3 py-4 mb-4" id="data-two">
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
                    <div class="box-data px-3 py-4 mb-4" id="data-three">
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
                    <div class="box-data px-3 py-4 mb-1" id="data-four">
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
                {{-- // calender location --}}
                <div class="l-data box-data px-2 pt-2 pb-5">
                    <div class="box-data">
                        <div class="date-vila">
                            <div class="date-start">
                                <span>تاریخ شروع</span>

                                <span>{{ count($datesSelected) > 0 ? jdate($datesSelected[0])->format('Y-m-d') : '---' }}</span>
                            </div>
                            <div class="date-exit">
                                <span>تاریخ خروج</span>
                                <span>{{ count($datesSelected) > 0 ? jdate($datesSelected[count($datesSelected) - 1])->format('Y-m-d') : '---' }}</span>
                            </div>
                        </div>
                        <div class="day-selected">
                            <h2>روزهای انتخابی</h2>
                        </div>
                        <div>
                            <div @click="coll=!coll" class="price-day selected-day-list">
                                <span>{{ count($datesSelected) . 'شب' }}</span>

                                <strong>{{ number_format($this->getTotalPrice()) }}</strong>
                            </div>
                            <div style="display: none" x-show="coll">
                                @foreach ($datesSelected as $dateItem)
                                    <div class="price-day selected-day-list">
                                        <span>{{ jdate($dateItem)->format('Y-m-d') }}</span>
                                        @if ($loop->index === count($datesSelected) - 1)
                                            <strong class="span-price-day">روز خروج</strong>
                                        @else
                                            <strong>{{ number_format($this->getPrice($dateItem)->first()->price) }}</strong>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        @if ($this->getTotalAdditionalPrice() > 0)
                            <div class="total-price">
                                <span> هزینه نفر اضافه ({{ $additionalCount . 'نفر' }})</span>
                                <strong>{{ number_format($this->getTotalAdditionalPrice()) }}</strong>
                            </div>
                        @endif
                        <div class="total-price">
                            <span>جمع کل {{ '(' . count($datesSelected) . 'شب' . ')' }}</span>
                            <strong>{{ number_format($this->getTotalPrice()) }}</strong>
                        </div>
                        @auth
                        <button class="btn-reserve" @click.prevent="$dispatch('open-modal' , {name: 'reserve'})">
                            ادامه
                        </button>
                        @endauth
                  @guest
                  <button class="btn-reserve" wire:click="checkAuth">
                    ورود و ادامه
                </button>
                  @endguest
                    </div>
                </div>
                <x-parnas.home-modal name="reserve">
                    <form wire:submit.prevent="submit" class="w-100 d-flex parent-form-info-villa">
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
                        @if (collect($residence->specifications)->has('paymentType') && $residence->specifications['paymentType'] === '2')
                            <button class="btn-reserve">
                                پرداخت
                            </button>
                            <button class="btn-reserve">
                                پرداخت از کیف پول
                            </button>
                        @else
                            <button class="btn-reserve">
                                درخواست رزرو
                            </button>
                        @endif
                    </form>
                </x-parnas.home-modal>

            </div>
        </div>
    </section>
</div>
