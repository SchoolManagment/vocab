<x-app-layout :back="route('book.index')">
    <h1>
        {!! __('book.show', ['book' => '<a href="'. route('book.show', $book) .'">'. $book->name .'</a>']) !!} -
        {{ __('chapter.index') }}
    </h1>

    <article>
        <a role="button" href="{{ route('book.ask', ['book' => $book, 'back' => request()->fullUrl]) }}" class="contrast">{{ __('vocab.start') }}</a>
        <a role="button" href="{{ route('book.chapter.create', compact('book')) }}">{{ __('chapter.create') }}</a>
    </article>

    <article>
        <table>
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{ __('chapter.name') }}</th>
                    <th scope="col">{{ __('chapter.word_count') }}</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($book->chapters as $chapter)
                    <tr>
                        <th scope="row">{{ $chapter->id }}</th>
                        <td>{{ $chapter->name }}</td>
                        <td>{{ $chapter->words()->count() }}</td>
                        <td>
                            <a href="{{ route('book.chapter.show', compact('book', 'chapter')) }}">{{ __('Showing') }}</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <th scope="row"></th>
                        <td>
                            <b>{{ __('Nothing Found!') }}</b>
                        </td>
                        <td></td>
                        <td></td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </article>
</x-app-layout>
