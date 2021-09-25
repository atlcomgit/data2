{{-- <x-input label="{{ __('Логин') }}" name="login" type="email" placeholder="login" required autofocus /> --}}

@props([
    'label' => null,
    'name' => null,
    'type' => 'text',
    'placeholder' => null,
    'required' => false,
    'autofocus' => false,
    'value' => null,
])

@php
    $id = Str::uuid();
    if (!empty(request()->old())) $value = old($name);
    if ($name == 'password') $value = '';
@endphp

<div class="mb-3">
    @isset($label)
        <label
            for="{{ $id }}"
            class="form-label{{ !!$required ? ' required' : '' }}"
        >
            {{ $label }}
        </label>
    @endisset

    <input
        id="{{ $id }}"
        class="form-control"
        type="{{ $type }}"
        @isset($name) name="{{ $name }}" @endisset
        @isset($value) value="{{ $value }}" @endisset
        @isset($placeholder) placeholder="{{ $placeholder }}" @endisset
        {{ !!$autofocus ? 'autofocus' : '' }}
    >
</div>
