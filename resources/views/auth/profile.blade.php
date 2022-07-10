<x-app-layout>
    <form action="{{ route('profile') }}" method="post">
        @csrf
        <h1>{{ __('auth-page.profile') }}</h1>

        <x-input name="name" :value="auth()->user()->name" :label="__('auth-page.name')" required autofocus :placeholder="__('auth-page.name')"/>
        <x-input type="email" name="email" :value="auth()->user()->email" :label="__('auth-page.email')" required :placeholder="__('auth-page.email')"/>
        <x-input type="password" name="password" :label="__('auth-page.password')" :placeholder="__('auth-page.password')"/>
        <x-input type="password" name="password_confirmation" :label="__('auth-page.password_confirm')" :placeholder="__('auth-page.password_confirm')"/>

        <button type="submit">{{ __('Update') }}</button>
    </form>
</x-app-layout>
