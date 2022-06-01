<div>
    <x-parnas.modal>
        <x-slot name="title">
            <h5 class="modal-title">ویرایش تصویر</h5>
        </x-slot>
        <form wire:submit.prevent="submit">
            <x-parnas.form-group class="d-flex justify-content-center">
                <img src="{{ $file['url'] }}" width="80" alt="">
            </x-parnas.form-group>
            <x-parnas.form-group class="mb-2">
                <x-parnas.label class="mb-1" for="alt">متن جایگزین</x-parnas.label>
                <x-parnas.inputs.text class="form-control form-control-sm" id="alt"
                                      wire:model.defer="file.alt"/>
                @error('file.alt')
                <p>{{ $message }}</p>
                @enderror
            </x-parnas.form-group>
            <x-parnas.form-group class="mb-2">
                <x-parnas.label class="mb-1" for="type">نوع</x-parnas.label>
                <x-parnas.inputs.select class="form-select form-select-sm" id="type"
                                        wire:model.defer="file.type">
                    <x-parnas.inputs.option value="{{ null }}">انتخاب نوع</x-parnas.inputs.option>
                    <x-parnas.inputs.option value="1">عکس شاخص</x-parnas.inputs.option>
                    <x-parnas.inputs.option value="2">گالری</x-parnas.inputs.option>
                    <x-parnas.inputs.option value="3">فایل</x-parnas.inputs.option>
                </x-parnas.inputs.select>
                @error('file.type')
                <p>{{ $message }}</p>
                @enderror
            </x-parnas.form-group>
            <x-parnas.form-group class="mb-2">
                <x-parnas.buttons.button class="btn btn-primary btn-sm"
                                         type="submit"
                                         wire:loading.attr="disabled" wire:target="upload"
                >
                    ویرایش
                </x-parnas.buttons.button>
            </x-parnas.form-group>
        </form>
    </x-parnas.modal>
</div>
