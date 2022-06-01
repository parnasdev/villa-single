<div>
    <form wire:submit.prevent="submit">
        <div class="card">
            <div class="card-header">
                اطلاعات
            </div>
            <div class="card-body">
                <div class="container">
                    <div class="row g-1">
                        <div class="col-md-6">
                            <x-parnas.form-group class="mb-2">
                                <x-parnas.label class="mb-1" for="name">نام</x-parnas.label>
                                <x-parnas.inputs.text class="form-control" id="name" wire:model.defer="user.name" />
                                @error('user.name')
                                <p>{{ $message }}</p>
                                @enderror
                            </x-parnas.form-group>
                        </div>
                        <div class="col-md-6">
                            <x-parnas.form-group class="mb-2">
                                <x-parnas.label class="mb-1" for="family">نام خانوادگی</x-parnas.label>
                                <x-parnas.inputs.text class="form-control" id="family" wire:model.defer="user.family" />
                                @error('user.family')
                                <p>{{ $message }}</p>
                                @enderror
                            </x-parnas.form-group>
                        </div>
                        <div class="col-md-12">
                            <x-parnas.form-group class="mb-2">
                                <x-parnas.label class="mb-1" for="role_id">مقام<span class="text-danger">*</span></x-parnas.label>
                                <x-parnas.inputs.select class="form-select" id="role_id" wire:model.defer="user.role_id">
                                    <x-parnas.inputs.option :value="null">
                                        -
                                    </x-parnas.inputs.option>
                                    @foreach($roles as $role)
                                        <x-parnas.inputs.option :value="$role->id">
                                            {{ $role->label }}
                                        </x-parnas.inputs.option>
                                    @endforeach
                                </x-parnas.inputs.select>
                                @error('user.role_id')
                                <p>{{ $message }}</p>
                                @enderror
                            </x-parnas.form-group>
                        </div>
                        <div class="col-md-12">
                            <p class="text-danger">یکی از موارد (شماره همراه ، نام کاربری ، ایمیل) الزامی میباشد.</p>
                        </div>
                        <div class="col-md-6">
                            <x-parnas.form-group class="mb-2">
                                <x-parnas.label class="mb-1" for="username">نام کاربری</x-parnas.label>
                                <x-parnas.inputs.text class="form-control" id="username" wire:model.defer="user.username" />
                                @error('user.username')
                                <p>{{ $message }}</p>
                                @enderror
                            </x-parnas.form-group>
                        </div>
                        <div class="col-md-6">
                            <x-parnas.form-group class="mb-2">
                                <x-parnas.label class="mb-1" for="phone">شماره همراه</x-parnas.label>
                                <x-parnas.inputs.text class="form-control" id="phone" wire:model.defer="user.phone" />
                                @error('user.phone')
                                <p>{{ $message }}</p>
                                @enderror
                            </x-parnas.form-group>
                        </div>
                        <div class="col-md-12">
                            <x-parnas.form-group class="mb-2">
                                <x-parnas.label class="mb-1" for="email">ایمیل</x-parnas.label>
                                <x-parnas.inputs.text class="form-control" id="email" wire:model.defer="user.email" />
                                @error('user.email')
                                <p>{{ $message }}</p>
                                @enderror
                            </x-parnas.form-group>
                        </div>
                        <div class="col-md-12">
                            <x-parnas.form-group class="mb-2">
                                <x-parnas.label class="mb-1" for="password">رمزعبور<span class="text-danger">*</span></x-parnas.label>
                                <x-parnas.inputs.text class="form-control" id="password" wire:model.defer="user.password" />
                                @error('user.password')
                                <p>{{ $message }}</p>
                                @enderror
                            </x-parnas.form-group>
                        </div>

                    </div>
                </div>
                <x-parnas.form-group class="mb-2">
                    <x-parnas.buttons.button class="btn btn-sm btn-primary">
                        ثبت
                    </x-parnas.buttons.button>
                </x-parnas.form-group>
            </div>
        </div>
    </form>
</div>
@push('title' , 'ایجاد کاربر')
