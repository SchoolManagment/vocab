<x-app-layout :back="route('book.show', $book)">
    <form action="{{ route('book.update', $book) }}" method="post">
        @csrf
        @method('PUT')
        <h1>Buch {{ $book->name }} bearbeiten</h1>

        <fieldset>
            <x-input name="name" label="Name" required placeholder="Name" :other_value="$book->name" />
        </fieldset>

        <fieldset>
            <x-select name="from_lang" label="von Sprache" required>
                <option selected disabled>Sprache auswählen</option>
                @foreach (config('languages') as $key => $lang)
                    <option value="{{ $key }}" @if ($key == $book->from_lang) selected @endif>{{ $lang }}</option>
                @endforeach
            </x-select>
        </fieldset>

        <fieldset>
            <x-select name="to_lang" label="zu Sprache" required>
                <option selected disabled>Sprache auswählen</option>
                @foreach (config('languages') as $key => $lang)
                    <option value="{{ $key }}" @if ($key == $book->to_lang) selected @endif>{{ $lang }}</option>
                @endforeach
            </x-select>
        </fieldset>

        <button type="submit">Buch {{ $book->name }} bearbeiten</button>
    </form>
</x-app-layout>
