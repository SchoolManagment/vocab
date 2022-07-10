<x-app-layout>
    <h1>{{ __('book.index') }}</h1>

    <table>
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">{{ __('Name') }}</th>
                <th scope="col">{{ __('book.lang') }}</th>
                <th scope="col">{{ __('book.chapter_count') }}</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th></th>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <a href="{{ route('book.create') }}" class="text-green">{{ __('book.create') }}</a>
                </td>
            </tr>
            @forelse ($books as $book)
                <tr>
                    <th scope="row">{{ $book->id }}</th>
                    <td>{{ $book->name }}</td>
                    <td>{{ $book->lang('from') }} <i class="ti ti-arrows-horizontal"></i> {{ $book->lang('to') }}</td>
                    <td>{{ $book->chapters()->count() }}</td>
                    <td>
                        <a href="{{ route('book.show', $book) }}">{{ __('Showing') }}</a>
                        <a href="{{ route('book.chapter.index', $book) }}" class="ml-3">{{ __('chapter.index') }}</a>
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
                    <td></td>
                </tr>
            @endforelse
        </tbody>
    </table>
</x-app-layout>
