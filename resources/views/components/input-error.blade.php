@props(['name'])
@error($name)
    <span style="color: red">{{ $message }}</span>
@enderror
