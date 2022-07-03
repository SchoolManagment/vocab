<x-app-layout :back="route('book.index')">
    <form action="{{ route('book.store') }}" method="post">
        @csrf
        <h1>Buch erstellen</h1>

        <fieldset>
            <x-input name="name" label="Name" required placeholder="Name"/>
        </fieldset>

        <fieldset>
            <x-select name="from_lang" label="von Sprache" required>
                <option selected disabled>Sprache auswählen</option>
                @foreach (config('languages') as $key => $lang)
                    <option value="{{ $key }}">{{ $lang }}</option>
                @endforeach
            </x-select>
        </fieldset>

        <fieldset>
            <x-select name="to_lang" label="zu Sprache" required>
                <option selected disabled>Sprache auswählen</option>
                @foreach (config('languages') as $key => $lang)
                    <option value="{{ $key }}" @if ($key == 'de') selected @endif>{{ $lang }}</option>
                @endforeach
            </x-select>
        </fieldset>

        <button type="submit">Buch erstellen</button>
    </form>
</x-app-layout>
