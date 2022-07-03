<x-app-layout>
    <h1>{{ __('Home') }}</h1>

    <article>
        {{ __('Welcome') }}, {{ auth()->user()->name }}!
    </article>
</x-app-layout>
