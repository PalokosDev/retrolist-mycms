<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>MyCMS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Google Font: Space Grotesk -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;700&display=swap" rel="stylesheet">

    <!-- Materialize CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" rel="stylesheet" />
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <style>
        body {
            font-family: 'Space Grotesk', sans-serif;
            margin:0;
            padding:0;
            transition: background 0.3s ease, color 0.3s ease;
            background: #f9f9f9;
            color: #222;
        }
        body.dark-mode {
            background: #121212;
            color: #e0e0e0;
        }

        .hero-section {
            position: relative;
            height: 300px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .hero-section::before {
            content: "";
            position: absolute;
            top:0; left:0; right:0; bottom:0;
            background: linear-gradient(45deg, rgba(30,144,255,0.4), rgba(255,105,180,0.4)), 
                        url('https://habborator.org/hotels/view_es_wide.gif') center center/cover no-repeat;
            filter: blur(3px) brightness(0.7);
            animation: moveBackground 20s linear infinite alternate;
            z-index: -1;
        }

        @keyframes moveBackground {
            0% { background-position: center center; }
            100% { background-position: center bottom; }
        }

        .hero-content {
            text-align: center;
            position: relative;
            z-index: 1;
            color: #fff;
        }

        .hero-title {
            font-size: 3rem;
            font-weight: 700;
            margin: 0;
            text-shadow: 0 2px 4px rgba(0,0,0,0.5);
        }

        .hero-subtitle {
            font-size: 1.2rem;
            margin-top: 10px;
            text-shadow: 0 1px 3px rgba(0,0,0,0.5);
        }

        nav {
            background: transparent;
            box-shadow: none;
            position: absolute;
            top: 0; left:0; right:0;
            z-index: 2;
            padding:0 20px;
        }
        nav .brand-logo, nav ul li a {
            color: #fff !important;
        }
        body.dark-mode nav .brand-logo,
        body.dark-mode nav ul li a {
            color: #fff !important;
        }

        /* Dropdown Styles */
        .dropdown-content {
            background: #fff !important;
        }
        .dropdown-content li>a, .dropdown-content li>span {
            color: #333 !important;
        }
        body.dark-mode .dropdown-content {
            background: #333 !important;
        }
        body.dark-mode .dropdown-content li>a, 
        body.dark-mode .dropdown-content li>span {
            color: #eee !important;
        }

        .theme-switch-container {
            display: flex;
            align-items: center;
            margin-left: 20px;
        }

        .theme-switch-label {
            margin-right: 10px;
            font-size: 0.9rem;
            color: #fff;
        }

        .theme-switch {
            position: relative;
            width: 50px;
            height: 25px;
            background: linear-gradient(to right, #f9d423, #ff4e50);
            border-radius: 25px;
            cursor: pointer;
            transition: background 0.4s ease;
            display:flex;
            align-items:center;
            justify-content: flex-start;
            padding: 0 5px;
        }

        .theme-switch.dark {
            background: linear-gradient(to right, #141E30, #243B55);
            justify-content: flex-end;
        }

        .theme-switch-handle {
            background: #fff;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display:flex;
            align-items:center;
            justify-content:center;
            font-size: 12px;
            transition: transform 0.4s ease;
        }

        .theme-switch-handle.light::before {
            content: "☀️";
        }

        .theme-switch-handle.dark::before {
            content: "🌙";
        }

        .info-popup {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: #fff;
            color: #333;
            padding: 15px 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            transition: opacity 0.3s ease, transform 0.3s ease;
            opacity: 0;
            transform: translateY(20px);
            z-index:9999;
        }
        body.dark-mode .info-popup {
            background: #333;
            color: #eee;
        }
        .info-popup.show {
            opacity: 1;
            transform: translateY(0);
        }
        .info-popup-close {
            background: transparent;
            border:none;
            color: inherit;
            float:right;
            cursor:pointer;
            font-size:16px;
        }
        .info-popup-message {
            margin:0; 
            padding:0; 
            font-size:0.9rem;
        }
    </style>
</head>
<body>
    <!-- Admin Dropdown -->
    @auth
    @if(Auth::user()->role === 'admin' || Auth::user()->role === 'editor')
    <ul id="admin-dropdown" class="dropdown-content">
        <li><a href="{{ route('admin.retrohotels.index') }}">Retrohotels verwalten</a></li>
        <li><a href="{{ route('admin.team_members.index') }}">User verwalten</a></li>
    </ul>
    @endif
    @endauth

    <div class="hero-section">
        <nav>
            <div class="nav-wrapper">
                <a href="{{ route('home') }}" class="brand-logo" style="display:flex; align-items:center;">
                    <img src="https://via.placeholder.com/40" alt="Logo" style="margin-right:10px;">
                    <span>MyCMS</span>
                </a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    <li><a href="{{ route('retroliste') }}">Retroliste</a></li>
                    <li><a href="{{ route('team') }}">Team</a></li>
                    @auth
                        @if(Auth::user()->role === 'admin' || Auth::user()->role === 'editor')
                            <!-- Admin Dropdown Trigger -->
                            <li><a class="dropdown-trigger" href="#!" data-target="admin-dropdown">Admin<i class="material-icons right">arrow_drop_down</i></a></li>
                        @endif
                        <li>
                            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                              @csrf
                              <button class="btn red" style="margin-top:15px;">Logout</button>
                            </form>
                        </li>
                    @endauth
                    @guest
                        <li><a href="{{ route('login') }}">Login</a></li>
                    @endguest
                    <!-- Dark/Light Mode Switch -->
                    <li>
                        <div class="theme-switch-container">
                            <span class="theme-switch-label">Dark Mode</span>
                            <div class="theme-switch" id="theme-switch">
                                <div class="theme-switch-handle light"></div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="hero-content">
            <h1 class="hero-title">Retroliste</h1>
            <h2 class="hero-subtitle">Deine Retroliste seit 2024</h2>
        </div>
    </div>

    <div class="container" style="margin-top:30px;">
        @yield('content')
    </div>

    <div class="info-popup" id="info-popup">
        <button class="info-popup-close" id="info-popup-close">×</button>
        <p class="info-popup-message">Zu hell? Zu dunkel? Wechsle hier die Ansicht!</p>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>
        // Dark/Light Mode
        const body = document.body;
        const themeSwitch = document.getElementById('theme-switch');
        const themeHandle = themeSwitch.querySelector('.theme-switch-handle');
        const currentTheme = localStorage.getItem('theme') || 'light';
        if (currentTheme === 'dark') {
            body.classList.add('dark-mode');
            themeSwitch.classList.add('dark');
            themeHandle.classList.remove('light');
            themeHandle.classList.add('dark');
        }

        themeSwitch.addEventListener('click', function() {
            if (body.classList.contains('dark-mode')) {
                body.classList.remove('dark-mode');
                localStorage.setItem('theme', 'light');
                themeSwitch.classList.remove('dark');
                themeHandle.classList.remove('dark');
                themeHandle.classList.add('light');
            } else {
                body.classList.add('dark-mode');
                localStorage.setItem('theme', 'dark');
                themeSwitch.classList.add('dark');
                themeHandle.classList.remove('light');
                themeHandle.classList.add('dark');
            }
        });

        // Info-Popup
        const infoPopup = document.getElementById('info-popup');
        const infoPopupClose = document.getElementById('info-popup-close');
        const popupClosed = localStorage.getItem('popupClosed');
        if (!popupClosed) {
            setTimeout(() => {
                infoPopup.classList.add('show');
            }, 5000); // nach 5 Sekunden
        }

        infoPopupClose.addEventListener('click', function() {
            infoPopup.classList.remove('show');
            localStorage.setItem('popupClosed', 'true');
        });

        // Materialize Dropdown Init
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('.dropdown-trigger');
            M.Dropdown.init(elems, {
                constrainWidth:false,
                coverTrigger:false
            });
        });
    </script>
</body>
</html>
