<div>
    @if (session()->has('message'))
        <x-parnas.alert color="{{ session('message')['icon'] }}">
            {{ session('message')['title'] }}
        </x-parnas.alert>
    @endif
        <x-parnas.buttons.link class="btn btn-sm btn-success" href="{{ route('admin.links.create') }}">
            <i class="fas fa-plus"></i>
        </x-parnas.buttons.link>
    <div class="table-responsive position-relative"
         x-data="">
        <x-parnas.spinners :full="true" wire:loading
                           wire:target="status , gotoPage , previousPage , nextPage , changeStatus , selectedAction , delete , forceDelete , selected"/>
        <table class="table table-bordered caption-top">
            <caption>

            </caption>
            <thead>
            <tr>
                <th>
                    #
                </th>
                <th>نوع</th>
                <th>وضعیت</th>
                <th>اقدام</th>
            </tr>
            </thead>
            <tbody>
            @forelse($links as $link)
                <tr>
                    <td>{{ $link->id }}</td>
                    <td>
                        {{ $link->type }}
                    </td>
                    <td x-data="">
                        <x-parnas.form-group class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="{{ $link->id }}" {{ $link->used ? 'checked' : '' }} @change="$wire.changeStatus({{ $link->id }})">
                            <x-parnas.label class="form-check-label" for="{{ $link->id }}"></x-parnas.label>
                        </x-parnas.form-group>
                    </td>
                    <td>
                        <x-parnas.buttons.link class="btn btn-sm btn-primary" href="{{ route('admin.links.edit' , ['link' => $link->id]) }}">
                            <i class="fas fa-edit"></i>
                        </x-parnas.buttons.link>
                        <x-parnas.buttons.button class="btn btn-sm btn-danger" wire:click="message({{ $link->id }} , false)">
                            <i class="fas fa-trash"></i>
                        </x-parnas.buttons.button>
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
</div>
@push('title' , 'منو سایت')
