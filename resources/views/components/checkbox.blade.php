@props([
    'label' => '',
    'name' => '',
    'required' => false,
    'checked' => null,
])
@php($id = Str::uuid())
@unless($checked) {{ $checked = old($name) }} @endunless

<div class="mb-3">
    <div class="form-check">
        <input class="form-check-input" type="checkbox" id="{{ $id }}" name="{{ $name }}" {{ !!$checked ? 'checked' : '' }}>
        @if ($label)
            <label class="form-check-label{{ !!$required ? ' required' : '' }}" for="{{ $id }}">{{ $label }}</label>
        @endif
    </div>
</div>
