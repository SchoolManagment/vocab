<x-app-layout>
    <form action="{{ route('logout') }}" method="post">
        @csrf
        <h1>Logout</h1>

        <article>
            Willst du dich wirklcih ausloggen?
        </article>

        <div class="gird">
            <button type="submit">Ja, logge mich aus.</button>
            <button type="button" onclick="window.location.href='{{ request()->back ?? route('home') }}';" class="secondary">Abbrechen</button>
        </div>
    </form>
</x-app-layout>
