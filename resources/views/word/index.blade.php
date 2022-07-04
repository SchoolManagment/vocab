<x-app-layout :back="route('book.section.show', compact('book', 'section'))">
    <h1>
        {{ __('Book') }} <a href="{{ route('book.show', $book) }}">{{ $book->name }}</a> -
        {{ __('Section') }} <a href="{{ route('book.section.show', compact('book', 'section')) }}">{{ $section->name }}</a> -
        {{ __('Words') }}
    </h1>

    <article>
        <a role="button" href="{{ route('book.ask', ['book' => $book, 'section' => $section, 'back' => request()->fullUrl]) }}" class="contrast">{{ __('Start Vocabulartest') }}</a>
        <a href="{{ route('book.section.word.create', compact('book', 'section')) }}" role="button">{{ __('Add Word') }}</a>
    </article>

    <article>
        <table>
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{ __('Word') }} <small>({{ $book->lang('from') }})</small></th>
                    <th scope="col">{{ __('Other meanings') }}</th>
                    <th scope="col">{{ __('Translations') }} <small>({{ $book->lang('to') }})</small></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($section->words as $word)
                    <tr>
                        <th scope="row">{{ $word->id }}</th>
                        <td>{{ $word->word }}</td>
                        <td>{{ $word->arrayToList($word->other_words ?? []) }}</td>
                        <td>{{ $word->arrayToList($word->translations ?? []) }}</td>
                        <td>
                            <a href="{{ route('book.section.word.show', compact('book', 'section', 'word')) }}">{{ __('Show') }}</a>
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
