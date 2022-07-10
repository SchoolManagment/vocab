<x-app-layout :back="route('book.chapter.word.index', compact('book', 'chapter'))">
    @livewire('word-form', compact('book', 'chapter'))
</x-app-layout>
