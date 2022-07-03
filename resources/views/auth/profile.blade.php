<x-app-layout>
    <form action="{{ route('profile') }}" method="post">
        @csrf
        <h1>Update Profile</h1>

        <x-input name="name" :value="auth()->user()->name" :label="__('Name')" required :placeholder="__('Name')"/>
        <x-input type="email" name="email" :value="auth()->user()->email" :label="__('E-Mail')" required :placeholder="__('E-Mail')"/>
        <x-input type="password" name="password" :label="__('Password')" :placeholder="__('Password')"/>
        <x-input type="password" name="password_confirmation" :label="__('Password Confirm')" :placeholder="__('Password Confirm')"/>

        <button type="submit">Update</button>
    </form>
</x-app-layout>
