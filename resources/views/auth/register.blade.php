<x-app-layout>
    <form action="{{ route('register') }}" method="post">
        @csrf
        <h1>Registrieren</h1>

        <x-input name="name" label="Name" placeholder="Name" autofocus required />
        <x-input type="email" name="email" label="E-Mail" placeholder="E-Mail" autofocus required />

        <div class="gird">
            <x-input type="password" name="password" placeholder="Passwort" label="Passwort bestätigen" required />
            <x-input type="password" name="password_confirmation" placeholder="Passwort bestätigen" label="Passwort bestätigen" required />
        </div>

        <button type="submit">Registrieren</button>
    </form>
</x-app-layout>
