<x-app-layout>
    <form action="{{ route('login') }}" method="post">
        @csrf
        <h1>{{ __('auth-page.login') }}</h1>

        <x-input type="email" name="email" label="{{ __('auth-page.email') }}" placeholder="{{ __('auth-page.email') }}" autofocus required />
        <x-input type="password" name="password" label="{{ __('auth-page.password') }}" placeholder="{{ __('auth-page.password') }}" required value="" />

        <button type="submit">{{ __('auth-page.login') }}</button>
    </form>
</x-app-layout>
