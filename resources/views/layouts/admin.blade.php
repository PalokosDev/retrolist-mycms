<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>MyCMS - Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Materialize & Hauptstyles sollten ja schon im base layout eingebunden sein -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" rel="stylesheet" />
    <style>
    body {
        font-family: 'Space Grotesk', sans-serif;
        margin:0; padding:0;
        transition: background 0.3s ease, color 0.3s ease;
        background: #f9f9f9;
        color:#222;
    }
    body.dark-mode {
        background: #121212;
        color: #e0e0e0;
    }
    nav {
        background: #1565c0;
    }
    body.dark-mode nav {
        background: #0d47a1;
    }
    .admin-header {
        background: transparent;
        padding:20px;
    }
    .admin-header h5 {
        margin-top:0;
        font-weight:700;
    }
    .card, .input-field input, .input-field textarea {
        background: #fff;
    }
    body.dark-mode .card, 
    body.dark-mode .input-field input,
    body.dark-mode .input-field textarea {
        background: #333;
        color: #ddd;
    }
    </style>
</head>
<body>
    <nav>
        <div class="nav-wrapper" style="padding:0 20px;">
            <a href="{{ route('home') }}" class="brand-logo">MyCMS Admin</a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a href="{{ route('admin.retrohotels.index') }}">Retrohotels</a></li>
                <li><a href="{{ route('admin.team_members.index') }}">Team</a></li>
                <li>
                    <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                        @csrf
                        <button class="btn red" style="margin-top:10px;">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container" style="margin-top:30px;">
        @yield('content')
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>
