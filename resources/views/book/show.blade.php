<x-app-layout :back="route('book.index')">
    <h1>{{ __('book.show', ['book' => $book->name]) }}</h1>

    <article>
        <header>
            {{ __('Informations') }}
        </header>

        <table>
            <tr>
                <th>{{ __('book.name') }}</th>
                <td>{{ $book->name }}</td>
            </tr>
            <tr>
                <th>{{ __('book.chapter_count') }}</th>
                <td>{{ $book->chapters()->count() }}</td>
            </tr>
            <tr>
                <th>{{ __('book.from_lang') }}</th>
                <td><span data-tooltip="{{ $book->from_lang }}">{{ $book->lang('from') }}</span></td>
            </tr>
            <tr>
                <th>{{ __('book.to_lang') }}</th>
                <td><span data-tooltip="{{ $book->to_lang }}">{{ $book->lang('to') }}</span></td>
            </tr>
            <tr>
                <th>{{ __('book.created_at') }}</th>
                <td><span data-tooltip="{{ $book->created_at }}">{{ $book->created_at->diffForHumans() }}</span></td>
            </tr>
            <tr>
                <th>{{ __('book.updated_at') }}</th>
                <td><span data-tooltip="{{ $book->updated_at }}">{{ $book->updated_at->diffForHumans() }}</span></td>
            </tr>
        </table>

        <a href="{{ route('book.ask', ['book' => $book, 'back' => request()->fullUrl]) }}" role="button" class="contrast">{{ __('book.vocab_test') }}</a>

        <a href="{{ route('book.chapter.index', $book) }}" role="button">{{ __('book.chapters') }}</a>

        <a href="{{ route('book.edit', $book) }}" role="button">{{ __('book.edit-btn') }}</a>

        <a href="{{ route('book.show', $book) }}/delete" class="bg-red" onclick="event.preventDefault();document.getElementById('delete-book').submit()" role="button" class="contrast">{{ __('book.delete-btn') }}</a>

        <form id="delete-book" action="{{ route('book.destroy', $book) }}" method="post">
            @csrf
            @method('DELETE')
        </form>
    </article>

    <article>
        <header>{{ __('vocab.results.title') }}</header>

        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ __('vocab.results.date') }}</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($results as $result)
                    <tr>
                        <th>{{ $result->id }}</th>
                        <td>{{ $result->day }}</td>
                        <td>
                            <a href="{{ route('result', $result->id) }}">{{ __('Showing') }}</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </article>
</x-app-layout>
