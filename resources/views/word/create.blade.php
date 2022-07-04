<x-app-layout :back="route('book.section.word.index', compact('book', 'section'))">
    @livewire('word-form', compact('book', 'section'))
</x-app-layout>
