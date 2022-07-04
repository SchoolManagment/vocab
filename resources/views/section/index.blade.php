<x-app-layout :back="route('book.index')">
    <h1>
        {{ __('Book') }} <a href="{{ route('book.show', $book) }}">{{ $book->name }}</a> -
        {{ __('Section') }}
    </h1>

    <article>
        <a role="button" href="{{ route('book.ask', $book) }}" class="contrast">{{ __('Start Vocabulartest') }}</a>
        <a role="button" href="{{ route('book.section.create', compact('book')) }}">{{ __('Create Section') }}</a>
    </article>

    <article>
        <table>
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{ __('Name') }}</th>
                    <th scope="col">{{ __('Wordcount') }}</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($book->sections as $section)
                    <tr>
                        <th scope="row">{{ $section->id }}</th>
                        <td>{{ $section->name }}</td>
                        <td>{{ $section->words()->count() }}</td>
                        <td>
                            <a href="{{ route('book.section.show', compact('book', 'section')) }}">{{ __('Show') }}</a>
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
