@props(['submit'])
<!-- Modal layout -->
<x-jet-dialog-modal wire:model="dropModal">
    <x-slot name="title">
        <h5 class="modal-title" id="eventModalLabel">Delete Event: {{ $this->startDate }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="closeModal()">
            <span aria-hidden="true">&times;</span>
        </button>
    </x-slot>
    <x-slot name="content">
        <form >
            <div class="px-4 py-5 bg-white sm:p-12 {{ isset($actions) ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md' }}">
                {{ __('Jestes pewien że chcesz usunąć event: :event', ['event' => $this->title]) }}
            </div>

        </form>
    </x-slot>
    <x-slot name="footer">
        <x-jet-secondary-button
            data-dismiss="modal"
            class="mr-2"
            wire:click="closeModal()"
        >
            {{ __('Close') }}
        </x-jet-secondary-button>
        <x-jet-button
            data-dismiss="modal"
            class="btn btn-primary"
            wire:click="dropEvent"
        >
            {{ __('Delete event') }}
        </x-jet-button>
    </x-slot>
</x-jet-dialog-modal>
