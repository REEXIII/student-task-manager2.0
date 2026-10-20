@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div class="login-page-wrapper">
        <div class="container small-container">

            <h1>Student Task Management System</h1>
            <h2>Login</h2>

            @if (session('success'))
                <div class="success-box">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="error-box">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login.store') }}">
                @csrf

                <div class="form-group">
                    <label for="login">Username or Email</label>

                    <input
                        type="text"
                        id="login"
                        name="login"
                        value="{{ old('login') }}"
                        autocomplete="username"
                        required
                        autofocus
                    >
                </div>

                <div class="form-group">
                    <label for="password">Password</label>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        autocomplete="current-password"
                        required
                    >
                </div>

                <button type="submit" class="btn">
                    Login
                </button>
            </form>

            <p class="auth-footer">
                Don't have an account?
                <a href="{{ route('register') }}">Register</a>
            </p>

        </div>
    </div>
@endsection
