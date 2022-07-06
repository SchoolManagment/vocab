<x-app-layout :back="route('book.chapter.index', $book)">
    <h1>
        {!! __('book.show', ['book' => '<a href="'. route('book.show', $book) .'">'. $book->name .'</a>']) !!} -
        {{ __('chapter.show', ['chapter' => $chapter->name]) }}
    </h1>

    <article>
        <header>
            {{ __('Informations') }}
        </header>

        <table>
            <tr>
                <th>{{ __('chapter.name') }}</th>
                <td>{{ $chapter->name }}</td>
            </tr>
            <tr>
                <th>{{ __('chapter.word_count') }}</th>
                <td>{{ $chapter->words()->count() }}</td>
            </tr>
            <tr>
                <th>{{ __('chapter.created_at') }}</th>
                <td><span data-tooltip="{{ $chapter->created_at }}">{{ $chapter->created_at->diffForHumans() }}</span></td>
            </tr>
            <tr>
                <th>{{ __('chapter.updated_at') }}</th>
                <td><span data-tooltip="{{ $chapter->updated_at }}">{{ $chapter->updated_at->diffForHumans() }}</span></td>
            </tr>
        </table>

        <a role="button" href="{{ route('book.ask', ['book' => $book, 'chapter' => $chapter, 'back' => request()->fullUrl]) }}" class="contrast">{{ __('vocab.start') }}</a>
        <a href="{{ route('book.chapter.word.index', compact('book', 'chapter')) }}" role="button">{{ __('chapter.words') }}</a>
        <a href="{{ route('book.chapter.edit', compact('book', 'chapter')) }}" role="button">{{ __('chapter.edit-btn') }}</a>
        <a href="{{ route('book.chapter.show', compact('book', 'chapter')) }}/delete" class="bg-red" onclick="event.preventDefault();document.getElementById('delete-chapter').submit()" role="button" class="contrast">{{ __('chapter.delete-btn') }}</a>

        <form id="delete-chapter" action="{{ route('book.chapter.destroy', compact('book', 'chapter')) }}" method="post">
            @csrf
            @method('DELETE')
        </form>
    </article>
</x-app-layout>
