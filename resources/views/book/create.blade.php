<x-app-layout :back="route('book.index')">
    <form action="{{ route('book.store') }}" method="post">
        @csrf
        <h1>{{ __('book.create') }}</h1>

        <fieldset>
            <x-input name="name" :label="__('Name')" required :placeholder="__('Name')" autofocus/>
        </fieldset>

        <fieldset>
            <x-select name="from_lang" :label="__('book.from_lang')" required>
                <option selected disabled>{{ __('book.select_lang') }}</option>
                @foreach (config('languages') as $key => $lang)
                    <option value="{{ $key }}">{{ __($lang) }}</option>
                @endforeach
            </x-select>
        </fieldset>

        <fieldset>
            <x-select name="to_lang" :label="__('book.to_lang')" required>
                <option selected disabled>{{ __('book.select_lang') }}</option>
                @foreach (config('languages') as $key => $lang)
                    <option value="{{ $key }}" @if ($key == App::getLocale() ?? 'de') selected @endif>{{ __($lang) }}</option>
                @endforeach
            </x-select>
        </fieldset>

        <button type="submit">{{ __('book.create') }}</button>
    </form>
</x-app-layout>
