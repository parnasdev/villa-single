{{-- @foreach ($residences as $item) --}}
{{-- <!--? child  --> --}}
{{-- <div class="swiper-data swiper-slide bg-white ms-3 mb-3" > --}}
{{-- <div class="over-background"></div> --}}
{{-- <div class="image"> --}}
{{-- <img src="/images/pic-01.png" alt="" /> --}}
{{-- </div> --}}
{{-- <div class="text data-info d-flex flex-column justify-content-between"> --}}
{{-- <div class="up-data"> --}}
{{-- <div class="title mb-1"> --}}
{{-- <span class="text-white">{{$item->title}}</span> --}}
{{-- </div> --}}
{{-- <div class="paragraph"> --}}
{{-- <span style="color: white">تاریخ ایجاد :</span> --}}
{{-- <p class="text-white"> --}}
{{-- {{jdate($item->created_at)->format('Y-m-d')}} --}}
{{-- </p> --}}
{{-- </div> --}}
{{-- <div class="text"> --}}
{{-- <p class="text-white">{{collect(config('vila.types'))->firstWhere('id',$residence->specifications['type']??0)['title']??''}}</p> --}}
{{-- </div> --}}
{{-- </div> --}}
{{-- <div class="price d-flex justify-content-end"> --}}
{{-- <a href="/info/{{$item->id}}">جزییات</a> --}}
{{-- </div> --}}
{{-- </div> --}}
{{-- </div> --}}
{{-- @endforeach --}}


<div style="padding-top: 5rem">
    <div class="prs-responsive">
        <div class="container-fluid">
            <div class="row">
               @if (count($residences) == 0)
               <div class="empty-villa">
                <svg  id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24" width="50" height="50"><path d="M24,9.924V18.5A5.506,5.506,0,0,1,18.5,24a1.5,1.5,0,0,1,0-3A2.5,2.5,0,0,0,21,18.5V9.924a2.5,2.5,0,0,0-1.1-2.073L13.3,3.4a2.306,2.306,0,0,0-2.593,0L4.1,7.851A2.5,2.5,0,0,0,3,9.924V18.5A2.5,2.5,0,0,0,5.5,21a1.5,1.5,0,0,1,0,3A5.506,5.506,0,0,1,0,18.5V9.924a5.5,5.5,0,0,1,2.423-4.56L9.025.91a5.29,5.29,0,0,1,5.95,0l6.6,4.454A5.5,5.5,0,0,1,24,9.924ZM19,15a6.95,6.95,0,0,1-2.05,4.949l-3.593,3.515a1.932,1.932,0,0,1-2.712,0L7.062,19.961A7,7,0,1,1,19,15Zm-3,0a4,4,0,1,0-6.829,2.828L12,20.6l2.84-2.779A3.963,3.963,0,0,0,16,15Zm-4-2a2,2,0,1,0,2,2A2,2,0,0,0,12,13Z"/></svg>
                <span>اقامتگاهی یافت نشد</span>
            </div>
               @endif

              @if (count($residences) !== 0)
              <div class="col-md-12 title-villa-main">
                <h5>دیگران کجاها سفر می کنند</h5>
                <h2>پرطرفدارترین شهرهای ایران</h2>
            </div>
              @endif
                <div class="col-md-12 villa-list-index">
                    @foreach ($residences as $item)
                        <div class="item-villa-index">
                            <div class="img-villa-item-parent">
                                <img src="{{ $item->residenceFiles()->first()->url }}" alt="">
                            </div>
                            <div class="title-villa-slider">
                                <h2 class="title-villa-index"><a href="/info/{{ $item->id }}">{{ $item->title }}</a>
                                </h2>
                                <strong>{{ number_format($item->residenceDates()->first()?->price) }}تومان</strong>
                            </div>
                            <span class="city-villa">
                                {{ $item->province()->first()?->title }}،{{ $item->city()->first()?->title }}
                            </span>
                            <div class="villa-details">
                                <div class="item">
                                    <svg id="Outline" viewBox="0 0 24 24" width="20" height="20">
                                        <path
                                            d="M22.485,10.975,12,17.267,1.515,10.975A1,1,0,1,0,.486,12.69l11,6.6a1,1,0,0,0,1.03,0l11-6.6a1,1,0,1,0-1.029-1.715Z" />
                                        <path
                                            d="M22.485,15.543,12,21.834,1.515,15.543A1,1,0,1,0,.486,17.258l11,6.6a1,1,0,0,0,1.03,0l11-6.6a1,1,0,1,0-1.029-1.715Z" />
                                        <path
                                            d="M12,14.773a2.976,2.976,0,0,1-1.531-.425L.485,8.357a1,1,0,0,1,0-1.714L10.469.652a2.973,2.973,0,0,1,3.062,0l9.984,5.991a1,1,0,0,1,0,1.714l-9.984,5.991A2.976,2.976,0,0,1,12,14.773ZM2.944,7.5,11.5,12.633a.974.974,0,0,0,1,0L21.056,7.5,12.5,2.367a.974.974,0,0,0-1,0h0Z" />
                                    </svg>
                                    <span>{{ $item->building_area }} متر مربع</span>
                                </div>
                                <div class="item">
                                    <svg xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24" width="22"
                                        height="22">
                                        <path
                                            d="M23.121,9.069,15.536,1.483a5.008,5.008,0,0,0-7.072,0L.879,9.069A2.978,2.978,0,0,0,0,11.19v9.817a3,3,0,0,0,3,3H21a3,3,0,0,0,3-3V11.19A2.978,2.978,0,0,0,23.121,9.069ZM15,22.007H9V18.073a3,3,0,0,1,6,0Zm7-1a1,1,0,0,1-1,1H17V18.073a5,5,0,0,0-10,0v3.934H3a1,1,0,0,1-1-1V11.19a1.008,1.008,0,0,1,.293-.707L9.878,2.9a3.008,3.008,0,0,1,4.244,0l7.585,7.586A1.008,1.008,0,0,1,22,11.19Z" />
                                    </svg>
                                    <span>{{ collect(config('vila.types'))->firstWhere('id', $item->specifications['type'] ?? 0)['title'] ?? '' }}</span>
                                </div>
                                <div class="item">
                                    <svg id="Outline" viewBox="0 0 24 24" width="22" height="22">
                                        <path
                                            d="M12,12A6,6,0,1,0,6,6,6.006,6.006,0,0,0,12,12ZM12,2A4,4,0,1,1,8,6,4,4,0,0,1,12,2Z" />
                                        <path
                                            d="M12,14a9.01,9.01,0,0,0-9,9,1,1,0,0,0,2,0,7,7,0,0,1,14,0,1,1,0,0,0,2,0A9.01,9.01,0,0,0,12,14Z" />
                                    </svg>
                                    <span> {{ $item->capacity }} نفر </span>
                                </div>
                                <div class="item">
                                    <svg id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24" width="22" height="22">
                                        <path
                                            d="M19,6H13A4.987,4.987,0,0,0,8.584,8.705,3.464,3.464,0,0,0,6.5,8,3.5,3.5,0,0,0,3,11.5,3.464,3.464,0,0,0,3.351,13H2V3A1,1,0,0,0,0,3V21a1,1,0,0,0,2,0V19H22v2a1,1,0,0,0,2,0V11A5.006,5.006,0,0,0,19,6Zm-9,5a3,3,0,0,1,3-3h6a3,3,0,0,1,3,3v2H10Zm-5,.5A1.5,1.5,0,1,1,6.5,13,1.5,1.5,0,0,1,5,11.5ZM2,17V15H22v2Z" />
                                    </svg>
                                    <span>{{ $item->room_count }} خوابه</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
</div>

@push('styles')
    <style>
        .villa-list-index {
            display: grid !important;
            grid-template-columns: 1fr 1fr 1fr;
        }
        .item-villa-index {
            width: 95%!important;
            margin-top: 20px;
        }

    </style>
@endpush
