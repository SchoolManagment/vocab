@props(['name', 'label' => null, 'required' => false, 'other_value' => null])

<x-label for="{{ $name }}" :required="$required">{{ $label ?? $slot }}</x-label>
<input id="{{ $name }}" name="{{ $name }}" @error($name) aria-invalid="true" @enderror @if ($required) required @endif {{ $attributes->merge(['type' => 'text', 'value' => old($name, request()->get($name, $other_value))]) }}>
<x-input-error name="{{ $name }}" />
