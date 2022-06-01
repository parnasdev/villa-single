<div>
    @if (session()->has('message'))
        <x-parnas.alert color="{{ session('message')['icon'] }}">
            {{ session('message')['title'] }}
        </x-parnas.alert>
    @endif
    <table class="table table-bordered caption-top">

        <thead>
        <tr>
            <th @click="ordering('id')">
                شناسه
            </th>
            <th>نام ونام خانوادگی</th>
            <th>شماره همراه</th>
            <th>تاریخ ورود</th>
            <th>تاریخ خروج</th>
            <th>تعداد افراد</th>
            <th>قیمت کل</th>
            <th>ویلا</th>
            <th>تاریخ ایجاد</th>
            <th>وضعیت</th>
            <th>اقدام</th>
        </tr>
        </thead>
        <tbody>

        @forelse($reserves as $item)
            <tr>

                <td>{{ $item->id }}</td>
                <td>
                    <a>{{ $item->name . ' ' . $item->family }}</a>
                </td>
                <td>{{$item->phone}}</td>
                <td>{{jdate($item->checkIn)->format('Y-m-d')}}</td>
                <td>{{jdate($item->checkOut)->format('Y-m-d')}}</td>
                <td>{{$item->count}}</td>
                <td>{{number_format($item->totalPrice)}}</td>
{{--                @dd(\Packages\Villa\src\Models\Residence::query()->where('id',$item->residence_id)->get('title')->first()->title)--}}
                <td>{{ $this->getVillaTitle($item->residence_id)}}</td>
                <td>
                    {{ jdate($item->created_at)->format('Y-m-d H:i') }}
                </td>
                <td x-data="">
                    <x-parnas.inputs.select class="form-select"
                                            @change="$wire.changeStatus({{ $item->id }} , $el.value)">
                        @foreach($statuses as $status)
                            <option value="{{$status->id}}" {{ $item->status_id == $status->id ? 'selected' : '' }}>
                                {{ $status->label }}
                            </option>
                        @endforeach
                    </x-parnas.inputs.select>
                </td>
                <td>
                    <x-parnas.buttons.link class="btn btn-sm btn-primary" href="/admin/villa/reserve-info/{{$item->id}}">
                        <i class="fas fa-edit"></i>
                    </x-parnas.buttons.link>
{{--                    <x-parnas.buttons.link class="btn btn-sm btn-primary" href="/admin/villa/priceManagement/{{$item->id}}">--}}
{{--                        <i class="fas fa-info"></i>--}}
{{--                    </x-parnas.buttons.link>--}}
{{--                    <x-parnas.buttons.link class="btn btn-sm btn-primary" href="/admin/villa/edit/{{$item->id}}">--}}
{{--                        <i class="fas fa-edit"></i>--}}
{{--                    </x-parnas.buttons.link>--}}

                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5">موردی یافت نشد!!!</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
