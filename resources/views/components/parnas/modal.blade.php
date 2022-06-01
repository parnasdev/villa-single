@props(['lg' => false])
<div class="modal fade"
     wire:ignore.self
    x-data="{
        modal: null,
        lg: '{{ $lg }}',
        init() {
            this.modal = new Bootstrap.Modal($el, {
                keyboard: false
            });
        },
        showModal() {
            this.modal.show();
        },
        closeModal() {
            this.modal.hide();
        }
    }"
    @open-modal.window="showModal()"
     @close-modal.window="closeModal()">
    <div class="modal-dialog " :class="{'modal-lg' : lg}">
        <div class="modal-content">
            <div class="modal-header">
                {{ $title ?? '' }}
                <button type="button" class="btn-close" @click="closeModal()"></button>
            </div>
            <div class="modal-body">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
