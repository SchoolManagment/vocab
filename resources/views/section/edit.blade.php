<x-app-layout :back="route('book.section.show', compact('book', 'section'))">
    <form action="{{ route('book.section.update', compact('book', 'section')) }}" method="post">
        @csrf
        @method('PUT')
        <h1>{{ __('Edit Section :section', ['section' => $section->name]) }}</h1>

        <fieldset>
            <x-input name="name" :label="__('Name')" required placeholder="__('Name')" :other_value="$section->name"/>
        </fieldset>

        <button type="submit">{{ __('Edit Section :section', ['section' => $section->name]) }}</button>
    </form>
</x-app-layout>
