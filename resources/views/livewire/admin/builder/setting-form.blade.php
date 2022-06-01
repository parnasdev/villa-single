<div>
    <x-parnas.modal :lg="true">
        <x-slot name="title">
            <h5 class="modal-title" id="staticBackdropLabel">تنظیمات</h5>
        </x-slot>
        <form wire:submit.prevent="submit">
            <div class="align-items-center" wire:loading.flex wire:target="submit">
                <strong>چند لحظه صبر کنید...</strong>
                <div class="spinner-border ms-auto" role="status" aria-hidden="true"></div>
            </div>
            @if(!is_null($item))
                @foreach($item['data'] ?? [] as $key => $data)
                    @php
                        $element = $this->convert($key);
                    @endphp

                    <x-parnas.form-group :label="$element['label']">
                        @if($element['type'] == 'text')
                            <x-parnas.inputs.text wire:model.defer="item.data.{{$key}}" error="{{$key}}"/>
                        @elseif($element['type'] == 'editor')
                            <div wire:ignore>
                                <x-parnas.inputs.editor id="{{ $key . rand() }}"
                                                        wire:model.debounce.1000ms="item.data.{{$key}}"/>
                            </div>
                        @elseif($element['type'] == 'file')
                            <x-parnas.inputs.file :file="$data" :model="'item.data.'.$key"/>
                        @elseif($element['type'] == 'textarea')
                            <div wire:ignore>
                                <x-parnas.inputs.textarea class="form-control" rows="10" wire:model.defer="item.data.{{$key}}"
                                                          error="{{$key}}"/>
                            </div>
                        @endif
                    </x-parnas.form-group>
                @endforeach
            @endif
            <x-parnas.buttons.button class="btn btn-sm btn-primary">
                ثبت
            </x-parnas.buttons.button>
        </form>
    </x-parnas.modal>
</div>
