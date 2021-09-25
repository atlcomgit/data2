{{-- <x-select :options="[''=>__('Все'), '1'=>__('первый')]" /> --}}

@props([
    'label' => 'Label',
    'name' => null,
    'value' => null,
    'options' => null,
])

@php
    $id = Str::uuid();
    if (!empty(request()->old())) $value = old($name);
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

    <select
        id="{{ $id }}"
        {{ @attributes->class(['form-control']) }}
        @isset($name) name="{{ $name }}" @endisset>
        @foreach ($options as $option_value => $option_label)
            <option
                value="{{ $option_value }}"
                {{ $option_value == $vale ? 'selected' : '' }}
            >
                {{ $option_label }}
            </option>
        @endforeach
    </select>
</div>
