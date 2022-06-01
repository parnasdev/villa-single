<div class="parent-page-home">
    <div class="section-one">
        <form wire:submit.prevent="submit" class="box-right-s1">
            <h1 class="title-main-index d-flex flex-column align-items-start">
                <strong class="pb-2">اقامت باما</strong>
                <h5 class="pb-3 ps-3">سامانه آنلاین و هوشمند رزرو اقامتگاه در سراسر ایران</h5>
            </h1>
            <span class="text-details-main">
                اجاره سوییت ، اجاره ویلا ، اجاره آپارتمان و اقامتگاه بوم گردی
            </span>
            <div class="box-search">
                <div class="item-search">
                    <label for="">انتخاب شهر</label>
                    <select name="" id="" wire:model="citySelected">
                        <option value="null">انتخاب کنید</option>

                        @foreach(\App\Models\City::query()->get() as $city)
                            <option value="{{$city->id}}">{{$city->title}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="item-search">
                    <label for="">تاریخ ورود</label>
                    <x-parnas.inputs.date-picker-popup :minDate="jdate()->format('Y/m/d')"  wire:model="startDate" />
                </div>
                <div class="item-search">
                    <label for="">تاریخ خروج</label>
{{--                    :maxDate="jdate($startDate)->addDays(9)->format('Y/m/d')"--}}
                    <x-parnas.inputs.date-picker-popup :minDate="jdate($startDate)->format('Y/m/d')"  wire:model="endDate" />
                </div>
                <div class="item-search" style="width:14%">
                    <label for="">تعداد شب</label>
                    <select name="" id="">
                        <option value="">1</option>
                        <option value="">2</option>
                        <option value="">3</option>
                        <option value="">4</option>
                        <option value="">5</option>
                        <option value="">6</option>
                        <option value="">7</option>
                        <option value="">8</option>
                        <option value="">9</option>
                    </select>
                </div>
                <button class="btn-search">
                    جستجو
                </button>
            </div>
        </form>
        <div class="box-left-s1">
            <div class="swiper mySwiper swiper-main">
                <div class="swiper-wrapper">
                    <div class="swiper-slide swiper-slide-img-s1">
                        <img src="images/villa1.jpeg" alt="">
                    </div>
                    <div class="swiper-slide swiper-slide-img-s1">
                        <img src="/images/villa2.jpeg" alt="">
                    </div>
                    {{--                    <div class="swiper-slide swiper-slide-img-s1">--}}
                    {{--                        <img src="/images/threevilla.webp" alt="">--}}
                    {{--                    </div>--}}

                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>
</div>
<div class="s2-index">
    <div class="prs-responsive">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 m-auto support-parent">
                    <div class="item-support">
                        <svg width="60" height="60" data-name="Layer 1" id="Layer_1" viewBox="0 0 512 512"
                             xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M501.64,307.63a29.67,29.67,0,0,0-19.93-28.24l-2.63-.93,1.2-2.52a30,30,0,0,0-31.78-42.48V46.57a5.15,5.15,0,0,0-5.15-5.15H15.52a5.16,5.16,0,0,0-5.16,5.15v312a5.15,5.15,0,0,0,5.16,5.15H335.73c.21,0,.43,0,.64,0a30.21,30.21,0,0,0,6.55,9.72,29.58,29.58,0,0,0,30.76,7.2v84.87a5.15,5.15,0,0,0,9.07,3.34l25.91-30.39,25.91,30.39a5.14,5.14,0,0,0,3.92,1.81,5.27,5.27,0,0,0,1.78-.32,5.14,5.14,0,0,0,3.37-4.83V380.56a30,30,0,0,0,36.64-41.25l-1.2-2.52,2.63-.93A29.66,29.66,0,0,0,501.64,307.63Zm-481,45.75V51.73H438.2V237l-.37.18-.93-2.63a29.68,29.68,0,0,0-28.23-19.93h0a29.65,29.65,0,0,0-28.23,19.93l-.94,2.63L377,236a30,30,0,0,0-39.93,39.93l1.2,2.52-2.63.93a30,30,0,0,0,0,56.47l2.63.93-1.2,2.52a30.13,30.13,0,0,0-2.93,14.07ZM412.58,427.1a5.15,5.15,0,0,0-7.84,0L384,451.44V387.66a30,30,0,0,0,49.35,0v63.78Zm65.68-101-8,2.85a5.16,5.16,0,0,0-2.93,7.06l3.65,7.68a19.65,19.65,0,0,1-26.19,26.19l-7.68-3.64a5.14,5.14,0,0,0-7.06,2.92l-2.85,8a19.67,19.67,0,0,1-37.06,0l-2.84-8a5.14,5.14,0,0,0-4.85-3.42,5.07,5.07,0,0,0-2.22.5l-7.67,3.64a19.65,19.65,0,0,1-26.19-26.19l3.64-7.68a5.14,5.14,0,0,0-2.92-7.06l-8-2.85a19.66,19.66,0,0,1,0-37l8-2.85a5.14,5.14,0,0,0,2.92-7.06l-3.64-7.68a19.65,19.65,0,0,1,26.19-26.19l7.67,3.64a5.15,5.15,0,0,0,7.07-2.92l2.84-8a19.67,19.67,0,0,1,37.06,0l2.85,8A5.14,5.14,0,0,0,437.1,249l7.68-3.64A19.66,19.66,0,0,1,471,271.51l-3.65,7.68a5.16,5.16,0,0,0,2.93,7.06l8,2.85a19.66,19.66,0,0,1,0,37Z"/>
                            <path
                                d="M408.66,252.8a54.83,54.83,0,1,0,54.83,54.83A54.88,54.88,0,0,0,408.66,252.8Zm0,99.35a44.53,44.53,0,1,1,44.53-44.52A44.57,44.57,0,0,1,408.66,352.15Z"/>
                            <path
                                d="M178.46,102.7a5.14,5.14,0,0,0-5.15-5.15H62.53a5.15,5.15,0,1,0,0,10.3H173.31A5.14,5.14,0,0,0,178.46,102.7Z"/>
                            <path
                                d="M109.49,164.65a5.14,5.14,0,0,0,5.15,5.15H344.23a5.15,5.15,0,0,0,0-10.3H114.64A5.14,5.14,0,0,0,109.49,164.65Z"/>
                            <path
                                d="M317.31,211.3a5.14,5.14,0,0,0-5.15-5.15H114.64a5.15,5.15,0,0,0,0,10.3H312.16A5.14,5.14,0,0,0,317.31,211.3Z"/>
                            <path d="M280.09,252.79H114.64a5.16,5.16,0,0,0,0,10.31H280.09a5.16,5.16,0,0,0,0-10.31Z"/>
                        </svg>
                        <h2>ضمانت تحویل اقامتگاه</h2>
                        <span>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است</span>
                    </div>
                    <div class="item-support">
                        <svg width="60" height="60" enable-background="new 0 0 50 50" height="50px" id="Layer_1"
                             version="1.1" viewBox="0 0 50 50" width="50px" xml:space="preserve"
                             xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><rect
                                fill="none" height="50" width="50"/>
                            <polyline fill="none" points="44,21 44,49 6,49   6,21 " stroke="#000000"
                                      stroke-linecap="round" stroke-miterlimit="10" stroke-width="2"/>
                            <polyline fill="none" points="19,49 19,28 31,28   31,49 " stroke="#000000"
                                      stroke-linecap="round" stroke-miterlimit="10" stroke-width="2"/>
                            <polygon points="35,5 35,8.016 37,10.094 37,7 39,7 39,12.203 41,14.266 41,5 "/>
                            <polyline fill="none" points="  1.11,25.942 25,1.053 48.89,25.943 " stroke="#000000"
                                      stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10"
                                      stroke-width="2"/></svg>
                        <h2>اقامتگاه های سراسر ایران</h2>
                        <span>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است</span>
                    </div>
                    <div class="item-support">
                        <svg width="60" height="60" enable-background="new 0 0 50 50" height="50px" id="Layer_1"
                             version="1.1" viewBox="0 0 50 50" width="50px" xml:space="preserve"
                             xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><rect
                                fill="none" height="50" width="50"/>
                            <path
                                d="M44,20c0-1.104-0.896-2-2-2s-2,0.896-2,2  c0,0.476,0,14.524,0,15c0,1.104,0.896,2,2,2s2-0.896,2-2C44,34.524,44,20.476,44,20z"
                                fill="none" stroke="#000000" stroke-miterlimit="10" stroke-width="2"/>
                            <path
                                d="M28,47c1.104,0,2-0.896,2-2s-0.896-2-2-2  c-0.476,0-4.524,0-5,0c-1.104,0-2,0.896-2,2s0.896,2,2,2C23.476,47,27.524,47,28,47z"
                                fill="none" stroke="#000000" stroke-miterlimit="10" stroke-width="2"/>
                            <path d="M8,19C8,9.611,15.611,2,25,2s17,7.611,17,17" fill="none" stroke="#000000"
                                  stroke-miterlimit="10" stroke-width="2"/>
                            <path d="M44,20c2.762,0,5,3.357,5,7.5  c0,4.141-2.238,7.5-5,7.5" fill="none"
                                  stroke="#000000" stroke-miterlimit="10" stroke-width="2"/>
                            <path
                                d="M6,20c0-1.104,0.896-2,2-2s2,0.896,2,2  c0,0.476,0,14.524,0,15c0,1.104-0.896,2-2,2s-2-0.896-2-2C6,34.524,6,20.476,6,20z"
                                fill="none" stroke="#000000" stroke-miterlimit="10" stroke-width="2"/>
                            <path d="M6,20c-2.761,0-5,3.357-5,7.5  C1,31.641,3.239,35,6,35" fill="none" stroke="#000000"
                                  stroke-miterlimit="10" stroke-width="2"/>
                            <path d="M42,37c0,5-3,8-8,8h-4" fill="none" stroke="#000000" stroke-miterlimit="10"
                                  stroke-width="2"/></svg>
                        <h2>پشتیبانی تا پایان سفر</h2>
                        <span>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است</span>
                    </div>

                </div>
                <div class="col-md-12 title-villa-main">
                    <h5>دیگران کجاها سفر می کنند</h5>
                    <h2>پرطرفدارترین شهرهای ایران</h2>
                </div>
                <!-- Swiper -->
                <div style="margin-top: 3rem" class="swiper mySwiper2">
                    <div class="swiper-wrapper">
                        @foreach($residences as $item)
                            <div class="swiper-slide">
                                <div class="item-villa-index">
                                    <div class="img-villa-item-parent">
                                        <img src="{{$item->residenceFiles()->first()->url}}" alt="">
                                    </div>
                                    <div class="title-villa-slider">
                                        <h2 class="title-villa-index"><a href="/info/{{$item->id}}">{{$item->title}}</a>
                                        </h2>
                                        <strong>{{ number_format($item->residenceDates()->first()?->price)  }}
                                            تومان</strong>
                                    </div>
                                    <span class="city-villa">
                                        {{$item->province()->first()->title}}،{{$item->city()->first()->title}}
                                    </span>
                                    <div class="villa-details">
                                        <div class="item">
                                            <svg id="Outline" viewBox="0 0 24 24" width="20" height="20">
                                                <path
                                                    d="M22.485,10.975,12,17.267,1.515,10.975A1,1,0,1,0,.486,12.69l11,6.6a1,1,0,0,0,1.03,0l11-6.6a1,1,0,1,0-1.029-1.715Z"/>
                                                <path
                                                    d="M22.485,15.543,12,21.834,1.515,15.543A1,1,0,1,0,.486,17.258l11,6.6a1,1,0,0,0,1.03,0l11-6.6a1,1,0,1,0-1.029-1.715Z"/>
                                                <path
                                                    d="M12,14.773a2.976,2.976,0,0,1-1.531-.425L.485,8.357a1,1,0,0,1,0-1.714L10.469.652a2.973,2.973,0,0,1,3.062,0l9.984,5.991a1,1,0,0,1,0,1.714l-9.984,5.991A2.976,2.976,0,0,1,12,14.773ZM2.944,7.5,11.5,12.633a.974.974,0,0,0,1,0L21.056,7.5,12.5,2.367a.974.974,0,0,0-1,0h0Z"/>
                                            </svg>
                                            <span>{{ $item->building_area }} متر مربع</span>
                                        </div>
                                        <div class="item">
                                            <svg xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24"
                                                 width="22" height="22">
                                                <path
                                                    d="M23.121,9.069,15.536,1.483a5.008,5.008,0,0,0-7.072,0L.879,9.069A2.978,2.978,0,0,0,0,11.19v9.817a3,3,0,0,0,3,3H21a3,3,0,0,0,3-3V11.19A2.978,2.978,0,0,0,23.121,9.069ZM15,22.007H9V18.073a3,3,0,0,1,6,0Zm7-1a1,1,0,0,1-1,1H17V18.073a5,5,0,0,0-10,0v3.934H3a1,1,0,0,1-1-1V11.19a1.008,1.008,0,0,1,.293-.707L9.878,2.9a3.008,3.008,0,0,1,4.244,0l7.585,7.586A1.008,1.008,0,0,1,22,11.19Z"/>
                                            </svg>
                                            <span>{{collect(config('vila.types'))->firstWhere('id',$item->specifications['type']??0)['title']??''}}</span>
                                        </div>
                                        <div class="item">
                                            <svg id="Outline" viewBox="0 0 24 24" width="22" height="22">
                                                <path
                                                    d="M12,12A6,6,0,1,0,6,6,6.006,6.006,0,0,0,12,12ZM12,2A4,4,0,1,1,8,6,4,4,0,0,1,12,2Z"/>
                                                <path
                                                    d="M12,14a9.01,9.01,0,0,0-9,9,1,1,0,0,0,2,0,7,7,0,0,1,14,0,1,1,0,0,0,2,0A9.01,9.01,0,0,0,12,14Z"/>
                                            </svg>
                                            <span> {{ $item->capacity }} نفر </span>
                                        </div>
                                        <div class="item">
                                            <svg id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24" width="22"
                                                 height="22">
                                                <path
                                                    d="M19,6H13A4.987,4.987,0,0,0,8.584,8.705,3.464,3.464,0,0,0,6.5,8,3.5,3.5,0,0,0,3,11.5,3.464,3.464,0,0,0,3.351,13H2V3A1,1,0,0,0,0,3V21a1,1,0,0,0,2,0V19H22v2a1,1,0,0,0,2,0V11A5.006,5.006,0,0,0,19,6Zm-9,5a3,3,0,0,1,3-3h6a3,3,0,0,1,3,3v2H10Zm-5,.5A1.5,1.5,0,1,1,6.5,13,1.5,1.5,0,0,1,5,11.5ZM2,17V15H22v2Z"/>
                                            </svg>
                                            <span>{{ $item->room_count }} خوابه</span>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        @endforeach
                    </div>
                </div>
                <div class="col-md-12 villa-list-index">

                </div>
                <div class="col-md-12  box-residence">
                    <img src="/images/backgrounf.png" alt="">

                </div>
                <div class="col-md-12 m-auto popular-city">
                    <div class="title-popular">
                        <h5>دیگران کجاها سفر می کنند</h5>
                        <h2>پرطرفدارترین شهرهای ایران</h2>
                    </div>
                    <div class="list-popular-city">
                        @foreach(\App\Models\City::query()->get()->slice(0, 5) as $city)
                            <div class="item-popular">
                                <div class="bg-dark-popular">
                                    <h2 class="title-city-popular"><a href="">{{$city->title}}</a></h2>
                                    <div class="count-residence">
                                        <a href="/list?city={{$city->id}}">استان {{$city->province()->first()->title}}</a>
                                        <svg fill="#fff" width="15" height="15" id="Layer_1"
                                             style="enable-background:new 0 0 50 50;" version="1.1" viewBox="0 0 50 50"
                                             xml:space="preserve" xmlns:xlink="http://www.w3.org/1999/xlink"><g
                                                id="Layer_1_1_">
                                                <polygon
                                                    points="37.561,47.293 15.267,25 37.561,2.707 36.146,1.293 12.439,25 36.146,48.707  "/>
                                            </g></svg>
                                    </div>
                                </div>
                                <div class="bg-popular-city">
                                    <img src="/images/pic-01.png" alt="">
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        const mobile = window.innerWidth < 480;
        const tablet = window.innerWidth < 780;
        var swiper = new Swiper(".mySwiper", {
            cssMode: true,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            pagination: {
                el: ".swiper-pagination",
            },
            mousewheel: true,
            keyboard: true,
        });
    </script>
    <script>
        var swiper = new Swiper(".mySwiper2", {
            effect: "coverflow",
            grabCursor: true,
            spaceBetween: mobile ? 7 : 20,
            centeredSlides: false,
            slidesPerView: mobile ? 1.2 : 3,
            coverflowEffect: {
                rotate: 50,
                stretch: 0,
                depth: 100,
                modifier: 1,
                slideShadows: true,
            },
            pagination: {
                el: ".swiper-pagination",
            },
        });
    </script>

@endpush
