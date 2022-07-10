<x-app-layout :back="route('book.chapter.show', compact('book', 'chapter'))">
    <h1>
        {!! __('book.show', ['book' => '<a href="'. route('book.show', compact('book')) .'">'. $book->name .'</a>']) !!} -
        {!! __('chapter.show', ['chapter' => '<a href="'. route('book.chapter.show', compact('book', 'chapter')) .'">'. $chapter->name .'</a>']) !!} -
        {{ __('word.index') }}
    </h1>

    <article>
        <a role="button" href="{{ route('book.ask', ['book' => $book, 'chapter' => $chapter, 'back' => request()->fullUrl]) }}" class="contrast">{{ __('vocab.start') }}</a>
        <a href="{{ route('book.chapter.word.create', compact('book', 'chapter')) }}" role="button">{{ __('word.create') }}</a>
    </article>

    <article>
        <table>
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{ __('word.word') }} <small>({{ $book->lang('from') }})</small></th>
                    <th scope="col">{{ __('word.others') }}</th>
                    <th scope="col">{{ __('word.trans') }} <small>({{ $book->lang('to') }})</small></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($chapter->words as $word)
                    <tr>
                        <th scope="row">{{ $word->id }}</th>
                        <td>{{ $word->word }}</td>
                        <td>{{ $word->arrayToList($word->other_words ?? []) }}</td>
                        <td>{{ $word->arrayToList($word->translations ?? []) }}</td>
                        <td>
                            <a href="{{ route('book.chapter.word.show', compact('book', 'chapter', 'word')) }}">{{ __('Showing') }}</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <th scope="row"></th>
                        <td>
                            <b>{{ __('Nothing Found!') }}!</b>
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </article>
</x-app-layout>
