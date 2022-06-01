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
                @if($trash)
                    <x-parnas.inputs.option value="2">
                        بازگردانی انتخابی ها
                    </x-parnas.inputs.option>
                @endif
            </x-parnas.inputs.select>
        </x-parnas.form-group>
        <div>
            <x-parnas.buttons.button class="btn btn-sm btn-outline-{{ $trash ? 'primary' : 'danger' }}"
                                     wire:click="showTrash">
                <i class="fas fa-{{ $trash ? 'eye' : 'trash'}}"></i>{{ $trash ? ' نمایش لیست' : ' نمایش سطل آشغال' }}
            </x-parnas.buttons.button>
        </div>
    </div>
    <div class="table-responsive position-relative"
         x-data="{
            ordering(col) {
                if  (col === $wire.get('orderCol')) {
                    $wire.set('ordering' , $wire.get('ordering') === 'desc' ? 'asc' : 'desc')
                }

                $wire.set('orderCol' , col)
            }
        }">
        <x-parnas.spinners :full="true" wire:loading
                           wire:target="status , gotoPage , previousPage , nextPage , changeStatus , selectedAction , delete , forceDelete , selected"/>
        <table class="table table-bordered caption-top">
            <caption>
                <x-parnas.form-group class="position-relative">
                    <x-parnas.inputs.text placeholder="جست و جو" wire:model="q" class="form-control"/>
                    <x-parnas.spinners :forBtn="true" wire:loading wire:target="q"
                                       class="position-absolute end-0 bottom-50"/>
                </x-parnas.form-group>
            </caption>
            <thead>
            <tr>
                <th>

                </th>
                <th @click="ordering('id')">
                    #
                </th>
                <th @click="ordering('name')">نام</th>
                <th @click="ordering('family')">نام خانوادگی</th>
                <th @click="ordering('phone')">شماره همراه</th>
                <th @click="ordering('email')">ایمیل</th>
                <th @click="ordering('username')">نام کاربری</th>
                <th>مقام</th>
                <th @click="ordering('last_login_at')">تاریخ آخرین ورود</th>
                <th>اقدام</th>
            </tr>
            </thead>
            <tbody>
            @forelse($users as $user)
                <tr>
                    <td>
                        @if(user()->id != $user->id)
                            <x-parnas.form-group class="form-check">
                                <x-parnas.inputs.text class="form-check-input" type="checkbox"
                                                      wire:model.defer="selected"
                                                      :value="$user->id" :id="$user->id"/>
                                <x-parnas.label class="form-check-label" :for="$user->id">
                                </x-parnas.label>
                            </x-parnas.form-group>
                        @endif
                    </td>
                    <td>{{ $user->id }}</td>
                    <td>
                        {{ $user->name }}
                    </td>
                    <td>
                        {{ $user->family }}
                    </td>
                    <td>
                        {{ $user->phone }}
                    </td>
                    <td>
                        {{ $user->email }}
                    </td>
                    <td>
                        {{ $user->username }}
                    </td>
                    <td>
                        {{ $user->role->label }}
                    </td>
                    <td>
                        {{ jdate($user->last_login_at)->format('Y-m-d H:i') }}
                    </td>
                    <td>
                        <x-parnas.buttons.link class="btn btn-sm btn-primary"
                                               href="{{ route('admin.users.edit' , ['user' => $user->id]) }}">
                            <i class="fas fa-edit"></i>
                        </x-parnas.buttons.link>
                        @if(user()->id != $user->id)
                            <x-parnas.buttons.button class="btn btn-sm btn-danger"
                                                     wire:click="message({{ $user->id }} , {{ $trash }})">
                                <i class="fas fa-trash"></i>
                            </x-parnas.buttons.button>
                        @endif
                        @if($user->trashed())
                            <x-parnas.buttons.button class="btn btn-sm btn-success"
                                                     wire:click="message({{ $user->id }} , {{ $trash }} , true)">
                                <i class="fas fa-redo-alt"></i>
                            </x-parnas.buttons.button>
                        @endif
                        <x-parnas.buttons.button class="btn btn-sm btn-secondary"
                                                 wire:click="changePassword({{ $user->id }})">
                            <i class="fas fa-lock"></i>
                        </x-parnas.buttons.button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="10">موردی یافت نشد!!!</td>
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
                    @if($trash)
                        <x-parnas.inputs.option value="2">
                            بازگردانی انتخابی ها
                        </x-parnas.inputs.option>
                    @endif
                </x-parnas.inputs.select>
            </x-parnas.form-group>
            {{ $users->links() }}
        </div>
    </div>
    <livewire:admin.users.user-change-password />
</div>

@push('title' , 'کاربران')
