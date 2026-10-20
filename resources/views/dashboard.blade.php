@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="dashboard-welcome">
        <h1>Welcome, {{ $user->full_name }}!</h1>
        <p>My Task Management System</p>
    </div>

    <div class="cards">

        <div class="card">
            Total Tasks
            <strong>{{ $tasks['total'] }}</strong>
        </div>

        <div class="card">
            Pending
            <strong>{{ $tasks['pending'] }}</strong>
        </div>

        <div class="card">
            Completed
            <strong>{{ $tasks['completed'] }}</strong>
        </div>

    </div>
@endsection
