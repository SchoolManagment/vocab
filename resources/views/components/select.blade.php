@props(['name', 'label', 'required' => false])

<x-label for="{{ $name }}" :required="$required">{{ $label }}</x-label>
<select id="{{ $name }}" name="{{ $name }}" @error($name) aria-invalid="true" @enderror @if ($required) required @endif {{ $attributes }}>
    {{ $slot }}
</select>
<x-input-error name="{{ $name }}" />
