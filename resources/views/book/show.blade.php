<x-app-layout :back="route('book.index')">
    <h1>Buch: {{ $book->name }}</h1>

    <article>
        <header>
            Informationen
        </header>

        <table>
            <tr>
                <th>Name</th>
                <td>{{ $book->name }}</td>
            </tr>
            <tr>
                <th>Kapitelanzahl</th>
                <td>{{ $book->sections()->count() }}</td>
            </tr>
            <tr>
                <th>von Sprache</th>
                <td><span data-tooltip="{{ $book->from_lang }}">{{ $book->lang('from') }}</span></td>
            </tr>
            <tr>
                <th>Kapitelanzahl</th>
                <td><span data-tooltip="{{ $book->to_lang }}">{{ $book->lang('to') }}</span></td>
            </tr>
            <tr>
                <th>Erstellt am</th>
                <td><span data-tooltip="{{ $book->created_at }}">{{ $book->created_at->diffForHumans() }}</span></td>
            </tr>
            <tr>
                <th>Zuletzt geändert am</th>
                <td><span data-tooltip="{{ $book->updated_at }}">{{ $book->updated_at->diffForHumans() }}</span></td>
            </tr>
        </table>

        <a href="{{ route('book.edit', $book) }}" role="button">Bearbeiten</a>

        <a href="{{ route('book.show', $book) }}/delete" class="bg-red" onclick="event.preventDefault();document.getElementById('delete-book').submit()" role="button" class="contrast">Löschen</a>

        <form id="delete-book" action="{{ route('book.destroy', $book) }}" method="post">
            @csrf
            @method('DELETE')
        </form>
    </article>
</x-app-layout>
