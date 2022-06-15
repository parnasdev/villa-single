<div class="modal fade" wire:ignore.self
    x-data="{
        modal: null,
        name: @js($name ?? 'default'),
        showModal(e) {
            let {name} = e.detail;

            if (name === this.name) {
                this.modal.show()
            }

            if (name === 'setAddress') {
                $dispatch('fixMap')
            }
        },
        closeModal(e) {
            let {name} = e.detail;
            if (name === this.name) {
                this.modal.hide()
            }
        }
    }"
     x-init="modal = new Bootstrap.Modal($el, {keyboard: false});"
     @open-modal.window="showModal"
     @close-modal.window="closeModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ $title ?? '' }}</h5>
                <button type="button" class="btn-close" @click="$dispatch('close-modal', { name: name })"></button>
            </div>
            <div class="modal-body">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
