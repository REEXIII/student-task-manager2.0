@extends('layouts.app')

@section('title', 'Register')

@section('content')
    <div class="login-page-wrapper register-page">
        <div class="small-container">

            <h1>Student Task Management System</h1>
            <h2>Create Account</h2>

            @if ($errors->any())
                <div class="error-box">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register.store') }}">
                @csrf

                <div class="form-group">
                    <label for="full_name">Full Name</label>

                    <input
                        type="text"
                        id="full_name"
                        name="full_name"
                        value="{{ old('full_name') }}"
                        maxlength="100"
                        autocomplete="name"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="username">Username</label>

                    <input
                        type="text"
                        id="username"
                        name="username"
                        value="{{ old('username') }}"
                        minlength="4"
                        maxlength="50"
                        autocomplete="username"
                        required
                    >

                    <small>Minimum of 4 characters.</small>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        maxlength="100"
                        autocomplete="email"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="password">Password</label>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        minlength="8"
                        autocomplete="new-password"
                        required
                    >

                    <small>Minimum of 8 characters.</small>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">
                        Confirm Password
                    </label>

                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        minlength="8"
                        autocomplete="new-password"
                        required
                    >
                </div>

                <button type="submit">
                    Register
                </button>

                <a href="{{ route('login') }}" class="cancel-link">
                    Back to Login
                </a>
            </form>

        </div>
    </div>
@endsection
