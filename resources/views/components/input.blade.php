@props([
    'label' => 'Label',
    'name' => '',
    'type' => 'text',
    'placeholder' => '',
    'required' => false,
    'autofocus' => false,
    'value' => null,
])
@php($id = Str::uuid())
@php($value = old($name))

<div class="mb-3">
    @if ($label)
        <label for="{{ $id }}" class="form-label{{ !!$required ? ' required' : '' }}">{{ $label }}</label>
    @endif
    <input class="form-control" id="{{ $id }}" type="{{ $type }}" name="{{ $name }}" placeholder="{{ $placeholder }}"
        @isset($value) value="{{ $value }}" @endisset {{ !!$autofocus ? 'autofocus' : '' }}>
</div>
