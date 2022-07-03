@props(['required' => false])

<label {{ $attributes }}>
    {!! $slot !!}

    @if ($required)
        <span style="color: red">*</span>
    @endif
</label>
