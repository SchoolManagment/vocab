<x-app-layout :back="route('book.section.index', $book)">
    <h1>{{ __('Section :section', ['section' => $section->name]) }} </h1>

    <article>
        <header>
            {{ __('Informations') }}
        </header>

        <table>
            <tr>
                <th>{{ __('Name') }}</th>
                <td>{{ $section->name }}</td>
            </tr>
            <tr>
                <th>{{ __('Wordcount') }}</th>
                <td>{{ $section->words()->count() }}</td>
            </tr>
            <tr>
                <th>{{ __('Created at') }}</th>
                <td><span data-tooltip="{{ $section->created_at }}">{{ $section->created_at->diffForHumans() }}</span></td>
            </tr>
            <tr>
                <th>{{ __('Updated at') }}</th>
                <td><span data-tooltip="{{ $section->updated_at }}">{{ $section->updated_at->diffForHumans() }}</span></td>
            </tr>
        </table>

        <a role="button" href="{{ route('book.ask', ['book' => $book, 'section' => $section]) }}" class="contrast">{{ __('Start Vocabulartest') }}</a>
        <a href="{{ route('book.section.word.index', compact('book', 'section')) }}" role="button">{{ __('Words') }}</a>
        <a href="{{ route('book.section.edit', compact('book', 'section')) }}" role="button">{{ __('Edit') }}</a>
        <a href="{{ route('book.section.show', compact('book', 'section')) }}/delete" class="bg-red" onclick="event.preventDefault();document.getElementById('delete-section').submit()" role="button" class="contrast">{{ __('Delete') }}</a>

        <form id="delete-section" action="{{ route('book.section.destroy', compact('book', 'section')) }}" method="post">
            @csrf
            @method('DELETE')
        </form>
    </article>
</x-app-layout>
