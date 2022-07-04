<x-app-layout>
    <h1>{{ __('Test Results') }} <a>#{{ $ask->id }}</a></h1>

    <article>
        <header>
            {{ __('Informations') }}
        </header>

        <table>
            <tr>
                <th>{{ __('Book') }}</th>
                <td>{{ $ask->book->name }} <a href="{{ route('book.show', $ask->book) }}">{{ __('Open Book') }}</a></td>
            </tr>
            <tr>
                <th>{{ __('Test Date') }}</th>
                <td><span data-tooltip="{{ $ask->day->diffForHumans() }}">{{ $ask->day }}</span></td>
            </tr>
        </table>
    </article>

    <article>
        <header>{{ __('Results') }}</header>

        <table>
            <thead>
                <tr>
                    <th>{{ __('Word') }}</th>
                    <th>{{ __('Score before') }}</th>
                    <th>{{ __('Score after') }}</th>
                    <th>{{ __('Difference') }}</th>
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
