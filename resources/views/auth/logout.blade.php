<x-app-layout>
    <form action="{{ route('logout') }}" method="post">
        @csrf
        <h1>{{ __('auth-page.logout') }}</h1>

        <article>
            {{ __('auth-page.logout-message') }}
        </article>

        <div class="gird">
            <button type="submit">{{ __('auth-pahe.logout.btn') }}</button>
            <button type="button" onclick="window.location.href='{{ request()->back ?? route('home') }}';" class="secondary">{{ __('Cancle') }}</button>
        </div>
    </form>
</x-app-layout>
