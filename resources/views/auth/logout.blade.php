<x-app-layout>
    <form action="{{ route('logout') }}" method="post">
        @csrf
        <h1>Logout</h1>

        <article>
            Willst du dich wirklcih ausloggen?
        </article>

        <button type="submit">Ja, logge mich aus.</button>
    </form>
</x-app-layout>
