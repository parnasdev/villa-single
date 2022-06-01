<div>
    @if (session()->has('message'))
        <x-parnas.alert color="{{ session('message')['icon'] }}">
            {{ session('message')['title'] }}
        </x-parnas.alert>
    @endif
    <div class="d-flex justify-content-between">
        <x-parnas.form-group class="mb-2 w-25">
            <x-parnas.label class="mb-2">عملیات انتخابی ها</x-parnas.label>
            <x-parnas.inputs.select class="form-select" wire:model="action" wire:change="actionMessage">
                <x-parnas.inputs.option value="0">
                    -
                </x-parnas.inputs.option>
                <x-parnas.inputs.option value="1">
                    حذف انتخابی ها
                </x-parnas.inputs.option>
            </x-parnas.inputs.select>
        </x-parnas.form-group>
        <div>
            <x-parnas.buttons.link class="btn btn-sm btn-success" href="{{ route('admin.roles.create') }}">
                <i class="fas fa-plus"></i>
            </x-parnas.buttons.link>
        </div>
    </div>
    <div class="table-responsive position-relative"
         x-data>
        <x-parnas.spinners :full="true" wire:loading
                           wire:target="gotoPage , previousPage , nextPage , selectedAction , delete"/>
        <table class="table table-bordered caption-top">
            <caption>
                {{--                <x-parnas.form-group class="position-relative">--}}
                {{--                    <x-parnas.inputs.text placeholder="جست و جو" wire:model="q" class="form-control"/>--}}
                {{--                    <x-parnas.spinners :forBtn="true" wire:loading wire:target="q"--}}
                {{--                                       class="position-absolute end-0 bottom-50"/>--}}
                {{--                </x-parnas.form-group>--}}
            </caption>
            <thead>
            <tr>
                <th>
                </th>
                <th>#</th>
                <th>نام</th>
                <th>برچسب</th>
                <th>اقدام</th>
            </tr>
            </thead>
            <tbody>
            @forelse($roles as $role)
                <tr>
                    <td>
                        @if(!$role->is_default)
                            <x-parnas.form-group class="form-check">
                                <x-parnas.inputs.text class="form-check-input" type="checkbox"
                                                      wire:model.defer="selected"
                                                      :value="$role->id" :id="$role->id"/>
                                <x-parnas.label class="form-check-label" :for="$role->id">
                                </x-parnas.label>
                            </x-parnas.form-group>
                        @endif
                    </td>
                    <td>{{ $role->id }}</td>
                    <td>
                        {{ $role->name }}
                    </td>
                    <td>
                        {{ $role->label }}
                    </td>
                    <td>

                        @if(!$role->is_default)
                            <x-parnas.buttons.link class="btn btn-sm btn-primary"
                                                   href="{{ route('admin.roles.edit' , ['role' => $role->id]) }}">
                                <i class="fas fa-edit"></i>
                            </x-parnas.buttons.link>
                            <x-parnas.buttons.button class="btn btn-sm btn-danger"
                                                     wire:click="message({{ $role->id }})">
                                <i class="fas fa-trash"></i>
                            </x-parnas.buttons.button>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">موردی یافت نشد!!!</td>
                </tr>
            @endforelse
            </tbody>
        </table>
        <div class="d-flex justify-content-between">
            <x-parnas.form-group class="mb-2 w-25">
                <x-parnas.label class="mb-2">عملیات انتخابی ها</x-parnas.label>
                <x-parnas.inputs.select class="form-select" wire:model="action" wire:change="actionMessage">
                    <x-parnas.inputs.option value="0">
                        -
                    </x-parnas.inputs.option>
                    <x-parnas.inputs.option value="1">
                        حذف انتخابی ها
                    </x-parnas.inputs.option>
                </x-parnas.inputs.select>
            </x-parnas.form-group>
            {{ $roles->links() }}
        </div>
    </div>
</div>

@push('title' , 'مقام ها')
