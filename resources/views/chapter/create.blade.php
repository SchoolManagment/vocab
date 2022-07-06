<x-app-layout :back="route('book.chapter.index', $book)">
    <form action="{{ route('book.chapter.store', $book) }}" method="post">
        @csrf
        <h1>
            {!! __('book.show', ['book' => '<a href="'. route('book.show', $book) .'">'. $book->name .'</a>']) !!} -
            {{ __('chapter.create') }}
        </h1>

        <fieldset>
            <x-input name="name" :label="__('chapter.name')" required :placeholder="__('chapter.name')"/>
        </fieldset>

        <button type="submit">{{ __('chapter.create') }}</button>
    </form>
</x-app-layout>
