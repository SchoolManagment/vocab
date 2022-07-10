<x-app-layout>
    <form action="{{ route('register') }}" method="post">
        @csrf
        <h1>{{ __('auth-page.register') }}</h1>

        <x-input name="name" :label="__('auth-page.name')" :placeholder="__('auth-page.name')" autofocus required />
        <x-input type="email" name="email" :label="__('auth-page.email')" :placeholder="__('auth-page.email')" required />

        <x-input type="password" name="password" :placeholder="__('auth-page.password')" :label="__('auth-page.password')" required />
        <x-input type="password" name="password_confirmation" :placeholder="__('auth-page.password_confirm')" :label="__('auth-page.password_confirm')" required />

        <button type="submit">{{ __('auth-page.register') }}</button>
    </form>
</x-app-layout>
