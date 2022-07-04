<x-app-layout>
    <h1>{{ __('Home') }}</h1>

    <article>
        {{ __('Welcome') }}, {{ auth()->user()->name }}!
    </article>

    <h2>Abfragen</h2>
    <article>

        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Buch</th>
                    <th>Datum</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($results as $result)
                    <tr>
                        <th>{{ $result->id }}</th>
                        <td>{{ $result->book->name }} | <a href="{{ route('book.show', $result->book) }}">Buch öffnen</a></td>
                        <td>{{ $result->day }}</td>
                        <td>
                            <a href="{{ route('result', $result->id) }}">Anzeigen</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <footer>
            {{ $results->links() }}
        </footer>
    </article>
</x-app-layout>
