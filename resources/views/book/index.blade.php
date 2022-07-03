<x-app-layout>
    <h1>Bücher</h1>

    <table>
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Sprache</th>
                <th scope="col">Kapitelanzahl</th>
                <th scope="col">Aktionen</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th></th>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <a href="{{ route('book.create') }}" class="text-green">Buch erstellen</a>
                </td>
            </tr>
            @forelse ($books as $book)
                <tr>
                    <th scope="row">{{ $book->id }}</th>
                    <td>{{ $book->name }}</td>
                    <td>{{ $book->lang('from') }} <i class="ti ti-arrows-horizontal"></i> {{ $book->lang('to') }}</td>
                    <td>{{ $book->sections()->count() }}</td>
                    <td>
                        <a href="{{ route('book.show', $book) }}">Ansehen</a>
                        <a href="{{ route('book.section.index', $book) }}" class="ml-3">Kapitel</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <th scope="row"></th>
                    <td>
                        <b>Nichts Gefunden!</b>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            @endforelse
        </tbody>
    </table>
</x-app-layout>
