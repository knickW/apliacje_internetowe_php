@extends('layouts.app')

@section('login')

<div id="loginModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <label for="email">E-Mail Address</label>
            <input type="email" name="email" required>

            <label for="password">Password</label>
            <input type="password" name="password" required>

            <button type="submit">Login</button>
        </form>

        <p>Nie masz konta? <a href="{{ route('register.form') }}">Zarejestruj się tutaj</a></p>
    </div>
</div>

@endsection