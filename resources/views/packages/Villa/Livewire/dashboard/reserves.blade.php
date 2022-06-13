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
                <td>{{jdate($item->checkIn)->format('Y-m-d')}}</td>
                <td>{{jdate($item->checkOut)->format('Y-m-d')}}</td>
                <td>{{$item->count}}</td>
                <td>{{number_format($item->totalPrice)}}</td>
                {{--                @dd(\Packages\Villa\src\Models\Residence::query()->where('id',$item->residence_id)->get('title')->first()->title)--}}
                <td>{{ $item->residence?->title}}</td>
                <td>
                    {{ jdate($item->created_at)->format('Y-m-d H:i') }}
                </td>
                <td x-data="">
                    {{$item->status->label}}
{{--                    {{\App\Models\Status::find($item->status_id)->label}}--}}
                </td>
                <td>
                   <x-parnas.buttons.link class="btn btn-sm btn-primary" href="/dashboard/villa/reserve-info/{{$item->id}}">
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
