<x-app-layout :back="route('book.section.word.index', compact('book', 'section'))">
    <h1>
        {{ __('Book') }} <a href="{{ route('book.show', $book) }}">{{ $book->name }}</a> -
        {{ __('Section') }} <a href="{{ route('book.section.show', compact('book', 'section')) }}">{{ $section->name }}</a> -
        {{ __('Word') }} {{ $word->word }}
    </h1>

    <article>
        <header>
            {{ __('Informations') }}
        </header>

        <table>
            <tr>
                <th>{{ __('Word') }}</th>
                <td>{{ $word->word }}</td>
            </tr>
            <tr>
                <th>{{ __('Score') }}</th>
                <td>{{ $word->score->score }}</td>
            </tr>
            <tr>
                <th>{{ __('Created at') }}</th>
                <td><span data-tooltip="{{ $word->created_at }}">{{ $word->created_at->diffForHumans() }}</span></td>
            </tr>
            <tr>
                <th>{{ __('Updated at') }}</th>
                <td><span data-tooltip="{{ $word->updated_at }}">{{ $word->updated_at->diffForHumans() }}</span></td>
            </tr>
        </table>

        <a href="{{ route('book.section.word.edit', compact('book', 'section', 'word')) }}" role="button">{{ __('Edit') }}</a>

        <a href="{{ route('book.section.word.show', compact('book', 'section', 'word')) }}/delete" class="bg-red" onclick="event.preventDefault();document.getElementById('delete-word').submit()" role="button" class="contrast">{{ __('Delete') }}</a>

        <form id="delete-word" action="{{ route('book.section.word.destroy', compact('book', 'section', 'word')) }}" method="post">
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
                <li>{{ $other_word }}</li>
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
                <li>{{ $translation }}</li>
            @empty
                <b>{{ __('Nothing Found!') }}!</b>
            @endforelse
        </ul>
    </article>
</x-app-layout>
