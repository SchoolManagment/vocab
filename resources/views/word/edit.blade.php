<x-app-layout :back="route('book.section.word.show', compact('book', 'section', 'word'))">
    @livewire('word-form', array_merge(compact('book', 'section', 'word'), ['edit' => true]))
</x-app-layout>
