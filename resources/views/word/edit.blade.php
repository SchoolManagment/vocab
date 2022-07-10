<x-app-layout :back="route('book.chapter.word.show', compact('book', 'chapter', 'word'))">
    @livewire('word-form', array_merge(compact('book', 'chapter', 'word'), ['edit' => true]))
</x-app-layout>
