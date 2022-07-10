<x-app-layout :back="route('book.chapter.word.index', compact('book', 'chapter'))">
    <h1>
        {!! __('book.show', ['book' => '<a href="'. route('book.show', compact('book')) .'">'. $book->name .'</a>']) !!} -
        {!! __('chapter.show', ['chapter' => '<a href="'. route('book.chapter.show', compact('book', 'chapter')) .'">'. $chapter->name .'</a>']) !!} -
        {{ __('word.show', ['book' => $word->word]) }}
    </h1>

    <article>
        <header>
            {{ __('Informations') }}
        </header>

        <table>
            <tr>
                <th>{{ __('word.word') }}</th>
                <td>{{ $word->word }}</td>
            </tr>
            <tr>
                <th>{{ __('word.score') }}</th>
                <td>{{ $word->score->score }}</td>
            </tr>
            <tr>
                <th>{{ __('word.created_at') }}</th>
                <td><span data-tooltip="{{ $word->created_at }}">{{ $word->created_at->diffForHumans() }}</span></td>
            </tr>
            <tr>
                <th>{{ __('word.updated_at') }}</th>
                <td><span data-tooltip="{{ $word->updated_at }}">{{ $word->updated_at->diffForHumans() }}</span></td>
            </tr>
        </table>

        <a href="{{ route('book.chapter.word.edit', compact('book', 'chapter', 'word')) }}" role="button">{{ __('word.edit-btn') }}</a>

        <a href="{{ route('book.chapter.word.show', compact('book', 'chapter', 'word')) }}/delete" class="bg-red" onclick="event.preventDefault();document.getElementById('delete-word').submit()" role="button" class="contrast">{{ __('word.delete-btn') }}</a>

        <form id="delete-word" action="{{ route('book.chapter.word.destroy', compact('book', 'chapter', 'word')) }}" method="post">
            @csrf
            @method('DELETE')
        </form>
    </article>

    <article>
        <header>
            {{ __('Other meanings') }}
        </header>

        <ul>
            @forelse ($word->other_words ?? [] as $other_word)
                <li>{{ urldecode($other_word) }}</li>
            @empty
                <b>{{ __('Nothing Found!') }}!</b>
            @endforelse
        </ul>
    </article>

    <article>
        <header>
            {{ __('Translations') }}
        </header>

        <ul>
            @forelse ($word->translations ?? [] as $translation)
                <li>{{ urldecode($translation) }}</li>
            @empty
                <b>{{ __('Nothing Found!') }}!</b>
            @endforelse
        </ul>
    </article>
</x-app-layout>
