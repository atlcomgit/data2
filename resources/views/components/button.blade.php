{{-- <x-button label="{{ __('Войти') }}" type="submit" /> --}}

@props([
    'label' => null,
    'name' => null,
    'value' => null,
    'type' => null,
    'color' => 'primary', // primary,success
    'size' => null, // sm
    'class'=> "",
])

@php
    $id = Str::uuid();
@endphp

<div class="mb-3 text-center">
    <button
        id="{{ $id }}"
        class="{{ isset($class) ? "{$class} " : '' }}btn{{ isset($color) ? " btn-{$color}" : '' }}{{ isset($size) ? " btn-{$size}" : '' }}"
        @isset($type) type="{{ $type }}" @endisset
        @isset($name) name="{{ $name }}" @endisset
        @isset($value) value="{{ $value }}" @endisset
    >
        @isset($label) {{ $label }} @endisset
    </button>
</div>
