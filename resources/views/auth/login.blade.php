<x-app-layout>
    <form action="{{ route('login') }}" method="post">
        @csrf
        <h1>Login</h1>

        <x-input type="email" name="email" label="E-Mail" placeholder="E-Mail" autofocus required />
        <x-input type="password" name="password" label="Passwort" placeholder="Passwort" required value="" />

        <button type="submit">Login</button>
    </form>
</x-app-layout>
