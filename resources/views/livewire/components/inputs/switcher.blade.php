<div class="form-group col-span-6 sm:col-span-5">
    <div class="control-label">{{ $label }}</div>
    <label class="custom-switch mt-2">
        <input type="checkbox" name="{{ $name }}" class="custom-switch-input" wire:model="isActive">
        <span class="custom-switch-indicator"></span>
    </label>
    <x-jet-input-error for="{{ $name }}" class="mt-2" />
</div>
