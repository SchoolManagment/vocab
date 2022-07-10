<x-app-layout :back="route('book.show', $book)">
    <form action="{{ route('book.update', $book) }}" method="post">
        @csrf
        @method('PUT')
        <h1>{{ __('book.edit', ['book' => $book->name]) }}</h1>

        <fieldset>
            <x-input name="name" :label="__('Name')" :placeholder="__('Name')" required autofocus :other_value="$book->name" />
        </fieldset>

        <fieldset>
            <x-select name="from_lang" :label="__('book.from_lang')" required>
                <option selected disabled>{{ __('book.select_lang') }}</option>
                @foreach (config('languages') as $key => $lang)
                    <option value="{{ $key }}" @if ($key == $book->from_lang) selected @endif>{{ $lang }}</option>
                @endforeach
            </x-select>
        </fieldset>

        <fieldset>
            <x-select name="to_lang" :label="__('book.to_lang')" required>
                <option selected disabled>{{ __('book.select_lang') }}</option>
                @foreach (config('languages') as $key => $lang)
                    <option value="{{ $key }}" @if ($key == $book->to_lang) selected @endif>{{ $lang }}</option>
                @endforeach
            </x-select>
        </fieldset>

        <button type="submit">{{ __('book.edit', ['book' => $book->name]) }}</button>
    </form>
</x-app-layout>
