<section class="p-3">
    <div class="title-info-page">
        <h2>اطلاعات رزرو</h2>
        <x-parnas.inputs.select class="form-select"
                                wire:model="reserve.status_id">
            @foreach($statuses as $status)
                <option value="{{$status->id}}">
                    {{ $status->label }}
                </option>
            @endforeach
        </x-parnas.inputs.select>
    </div>
    <div class="info-reserve-page">
        <div class="item-page">
            <label for="">نام و نام خانوادگی :</label>
            <span>{{$reserve->name.' '.$reserve->family}}</span>
        </div>
        <div class="item-page">
            <label for=""> شماره همراه :</label>
            <span> {{$reserve->phone}}</span>
        </div>
        <div class="item-page">
            <label for="">تاریخ ایجاد </label>
            <span>{{jdate($reserve->create_at)->format('Y-m-d')}}</span>
        </div>
    </div>
    <div class="title-info-page">
        <h2> اطلاعات درخواستی</h2>
    </div>
    <div class="info-request-page">
        <div class="item-page">
            <label for=""> نام ویلا :</label>
            <span>{{$this->getVillaItem($reserve->residence_id)?->title}}</span>
        </div>
        <div class="item-page">
            <label for="">شناسه ویلا :</label>
            <span>{{$reserve->residence_id}}</span>
        </div>
        <div class="item-page">
            <label for="">قیمت کل پرداختی :</label>
            <span>{{number_format($reserve->totalPrice)}}</span>
        </div>
        <div class="item-page">
            <label for="">تارخ ورود :</label>
            <span>{{jdate($reserve->checkIn)->format('Y-m-d')}}</span>
        </div>
        <div class="item-page">
            <label for="">تاریخ خروج :</label>
            <span>{{jdate($reserve->checkIn)->format('Y-m-d')}}</span>
        </div>
        <div class="item-page">
            <label for="">تعداد افراد :</label>
            <span>{{$reserve->count.' '.'نفر'}}</span>
        </div>
    </div>
    <div class="title-info-page">
        <h2> روزهای درخواستی</h2>
    </div>
    <div class="item-date-price">
        @foreach($this->getBetweenDates($reserve->checkIn,$reserve->checkOut) as $x)
        <div class="item-page-2">
            <span class="date">{{jdate($x)->format('Y-m-d')}}</span>
            @if($loop->index === count($this->getBetweenDates($reserve->checkIn,$reserve->checkOut))-1)
                <span>رایگان</span>
            @else
            <span class="price">{{number_format($this->getDatePrice($x)->price)}} تومان</span>
            @endif
        </div>
        @endforeach

    </div>
</section>
