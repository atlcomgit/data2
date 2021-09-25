{{-- <x-checkbox label="{{ __('Запомнить') }}" name="remember" checked /> --}}

@props([
    'label' => null,
    'name' => null,
    'required' => false,
    'checked' => null,
])

@php
    //dump(request()->old());
    $id = Str::uuid();
    if (!empty(request()->old())) $checked = old($name);
@endphp


<div class="mb-3">
    <div class="form-check">
        <input
            id="{{ $id }}"
            class="form-check-input"
            type="checkbox"
            @isset($name) name="{{ $name }}" @endisset
            {{ !!$checked ? 'checked' : '' }}
            >

        @isset($label)
            <label
                class="form-check-label{{ !!$required ? ' required' : '' }}"
                for="{{ $id }}"
            >
                {{ $label }}
            </label>
        @endisset
    </div>
</div>
