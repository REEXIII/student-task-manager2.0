<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Student Task Management System')</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    @auth
        <div class="container" id="header">
            <div class="header-content">
                <a href="{{ route('dashboard') }}" class="brand-title">
                    My Task Manager
                </a>

                <nav class="top-nav">
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        Dashboard
                    </a>

                    <a href="{{ route('tasks.index') }}" class="nav-link">
                        All Tasks
                    </a>

                    <a href="{{ route('tasks.create') }}"
                       class="nav-link nav-add">
                        + Add Task
                    </a>

                    <form method="POST"
                          action="{{ route('logout') }}"
                          class="logout-form">
                        @csrf

                        <button type="submit" class="nav-link logout-link">
                            Logout
                        </button>
                    </form>
                </nav>
            </div>
        </div>
    @endauth

    <main>
        @yield('content')
    </main>

    <footer>
        <p>
            &copy; {{ date('Y') }} Student Task Management System.
            All rights reserved.
        </p>
    </footer>

    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
