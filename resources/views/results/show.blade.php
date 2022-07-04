<x-app-layout>
    <h1>Abfrage <a>#{{ $ask->id }}</a></h1>

    <article>
        <header>
            Informationen
        </header>

        <table>
            <tr>
                <th>Buch</th>
                <td>{{ $ask->book->name }} <a href="{{ route('book.show', $ask->book) }}">Buch öffnen</a></td>
            </tr>
            <tr>
                <th>Abfrage war am</th>
                <td><span data-tooltip="{{ $ask->day->diffForHumans() }}">{{ $ask->day }}</span></td>
            </tr>
        </table>
    </article>

    <article>
        <header>Ergebnisse</header>

        <table>
            <thead>
                <tr>
                    <th>Wort</th>
                    <th>Score zuvor</th>
                    <th>Jetziger Score</th>
                    <th>Differenz</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ask->words ?? [] as $result)
                    <tr>
                        <th>{{ $result['word'] }}</th>
                        <td>{{ $result['score'] }}</td>
                        <td>
                            <span class="@if(($scoreDiff = ($result['new_score'] - $result['score'])) > 0) text-green @elseif ($scoreDiff < 0) text-red @endif">
                                {{ $result['new_score'] }}
                            </span>
                        </td>
                        <td>
                            <span class="@if($scoreDiff > 0) text-green @elseif ($scoreDiff < 0) text-red @endif">
                                @if(($scoreDiff = ($result['new_score'] - $result['score'])) > 0) + {{ $scoreDiff }} @elseif ($scoreDiff < 0) - {{ -$scoreDiff }} @else {{ $scoreDiff }} @endif
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </article>
</x-app-layout>
