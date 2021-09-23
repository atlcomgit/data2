@props([
    'label' => '',
    'type' => 'submit',
    'color' => 'primary', // primary,success
    'size' => null, // sm
])

<div class="mb-3">
    <button type="{{ $type }}"
        class="btn{{ isset($color) ? " btn-{$color}" : '' }}{{ isset($size) ? " btn-{$size}" : '' }}">{{ $label }}</button>
</div>
