<x-app-layout :back="route('book.chapter.show', compact('book', 'chapter'))">
    <form action="{{ route('book.chapter.update', compact('book', 'chapter')) }}" method="post">
        @csrf
        @method('PUT')
        <h1>
            {!! __('book.show', ['book' => '<a href="'. route('book.show', $book) .'">'. $book->name .'</a>']) !!} -
            {{ __('chapter.edit', ['chapter' => $chapter->name]) }}
        </h1>

        <fieldset>
            <x-input name="name" :label="__('chapter.name')" required placeholder="__('chapter.name')" :other_value="$chapter->name"/>
        </fieldset>

        <button type="submit">{{ __('chapter.edit', ['chapter' => $chapter->name]) }}</button>
    </form>
</x-app-layout>
