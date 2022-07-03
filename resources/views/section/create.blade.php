<x-app-layout :back="route('book.section.index', $book)">
    <form action="{{ route('book.section.store', $book) }}" method="post">
        @csrf
        <h1>{{ __('Create Section') }}</h1>

        <fieldset>
            <x-input name="name" :label="__('Name')" required :placeholder="__('Name')"/>
        </fieldset>

        <button type="submit">{{ __('Create Section') }}</button>
    </form>
</x-app-layout>
