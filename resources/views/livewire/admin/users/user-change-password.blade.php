<div>
    <x-parnas.modal>
        <x-slot name="title">
            <h5 class="modal-title">تغییر رمز عبور</h5>
        </x-slot>
        <form wire:submit.prevent="submit">
            <x-parnas.form-group class="mb-2">
                <x-parnas.label for="password">رمز عبور</x-parnas.label>
                <x-parnas.inputs.text class="form-control" wire:model.defer="password" id="password" />
                @error('password')
                <p>{{ $message }}</p>
                @enderror
            </x-parnas.form-group>
            <x-parnas.form-group class="mb-2">
                <x-parnas.buttons.button class="btn btn-sm btn-primary">
                    ثبت
                </x-parnas.buttons.button>
            </x-parnas.form-group>
        </form>
    </x-parnas.modal>
</div>
