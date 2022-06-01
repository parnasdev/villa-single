<div>
    <form wire:submit.prevent="submit">
        <x-parnas.card>
            <x-slot name="title">
                اطلاعات
            </x-slot>
            <div class="container">
                <div class="row g-1">
                    <div class="col-md-12">
                        <x-parnas.form-group class="mb-2">
                            <x-parnas.label class="mb-1" for="name">نام</x-parnas.label>
                            <x-parnas.inputs.text class="form-control" id="name"
                                                  wire:model.defer="role.name"/>
                            @error('role.name')
                            <p>{{ $message }}</p>
                            @enderror
                        </x-parnas.form-group>
                        <x-parnas.form-group class="mb-2">
                            <x-parnas.label class="mb-1" for="label">برچسپ</x-parnas.label>
                            <x-parnas.inputs.text id="label" class="form-control"
                                                  wire:model.defer="role.label"/>
                            @error('role.label')
                            <p>{{ $message }}</p>
                            @enderror
                        </x-parnas.form-group>
                        <x-parnas.form-group class="mb-2" wire:ignore>
                            <x-parnas.label class="mb-1" for="permissions">دسترسی ها</x-parnas.label>
                            <x-parnas.inputs.select2 class="form-select" id="permissions" multiple placeholder="انتخاب دسترسی" wire:model="permissionIds">
                                @foreach($permissions as $permission)
                                    <x-parnas.inputs.option :value="$permission->id">
                                        {{ $permission->label }}
                                    </x-parnas.inputs.option>
                                @endforeach
                            </x-parnas.inputs.select2>
                            @error('role.label')
                            <p>{{ $message }}</p>
                            @enderror
                        </x-parnas.form-group>
                        <x-parnas.form-group class="form-check mb-2">
                            <x-parnas.label class="mb-1" for="see_all_post">نمایش همه پست ها</x-parnas.label>
                            <x-parnas.inputs.text type="checkbox" name="see_all_post" value="1" id="see_all_post" class="form-check-input"
                                                  wire:model="role.see_all_post"/>
                            @error('role.see_all_post')
                            <p>{{ $message }}</p>
                            @enderror
                        </x-parnas.form-group>
                        <x-parnas.form-group class="form-check mb-2">
                            <x-parnas.label class="mb-1" for="access_panel">دسترسی به پنل</x-parnas.label>
                            <x-parnas.inputs.text type="checkbox" value="1" name="access" id="access_panel" class="form-check-input" id="access_panel"
                                                  wire:model="role.is_access_panel"/>
                            @error('role.is_access_panel')
                            <p>{{ $message }}</p>
                            @enderror
                        </x-parnas.form-group>
                        <x-parnas.form-group class="form-check mb-2">
                            <x-parnas.label class="mb-1" for="access_dashboard">دسترسی به داشبورد</x-parnas.label>
                            <x-parnas.inputs.text type="checkbox" value="1" name="access" id="access_dashboard" class="form-check-input"
                                                  wire:model="role.is_access_dashboard"/>
                            @error('role.is_access_dashboard')
                            <p>{{ $message }}</p>
                            @enderror
                        </x-parnas.form-group>
                        <x-parnas.form-group class="form-check mb-2">
                            <x-parnas.label class="mb-1" for="access_custom">دسترسی به مسیر دیگر</x-parnas.label>
                            <x-parnas.inputs.text type="checkbox" name="access" value="1" id="access_custom" class="form-check-input"
                                                  wire:model="role.is_custom"/>
                            @error('role.is_custom')
                            <p>{{ $message }}</p>
                            @enderror
                        </x-parnas.form-group>
                        <p class="text-danger">برای وارد کردن نام مسیر با تیم پشتیبانی پارناس تماس حاصل فرماید</p>
                        <x-parnas.form-group class="mb-2">
                            <x-parnas.label class="mb-1"  for="access_route">نام مسیر</x-parnas.label>
                            <input id="access_route" name="access" class="form-control" id="access_route"
                                   wire:model.defer="role.custom_route_name_access"  {{ !$role->is_custom ? 'disabled' : '' }}>
                            @error('role.custom_route_name_access')
                            <p>{{ $message }}</p>
                            @enderror
                        </x-parnas.form-group>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex justify-content-end">
                            <x-parnas.buttons.button class="btn btn-sm btn-primary">
                                ثبت
                            </x-parnas.buttons.button>
                        </div>
                    </div>
                </div>
            </div>
        </x-parnas.card>
    </form>
</div>

@push('title' , 'مقام ها')
