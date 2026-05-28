<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>{{ $title ?? 'Mantilla Funeral Reservation System' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        :root {
            --bg-main: #070707;
            --bg-soft: #0f0d0b;
            --bg-card: rgba(25, 20, 15, 0.82);
            --bg-card-solid: #171310;
            --gold: #d6a84f;
            --gold-light: #f3d891;
            --gold-dark: #8b6425;
            --brown: #2c1f16;
            --cream: #f8ead2;
            --muted: #b9aa94;
            --white: #ffffff;
            --danger: #e15b64;
            --success: #65d69e;
            --warning: #f1c75d;
            --info: #75b8ff;
            --border: rgba(214, 168, 79, 0.22);
            --shadow: 0 24px 70px rgba(0, 0, 0, 0.55);
            --soft-shadow: 0 14px 35px rgba(0, 0, 0, 0.32);
            --radius-lg: 26px;
            --radius-md: 18px;
            --radius-sm: 12px;
        }

        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: "Segoe UI", Arial, sans-serif;
            color: var(--cream);
            background:
                radial-gradient(circle at top left, rgba(214, 168, 79, 0.18), transparent 34%),
                radial-gradient(circle at 85% 12%, rgba(243, 216, 145, 0.11), transparent 30%),
                radial-gradient(circle at 50% 90%, rgba(139, 100, 37, 0.16), transparent 35%),
                linear-gradient(135deg, #050505 0%, #100c08 45%, #050505 100%);
            overflow-x: hidden;
        }

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            background-image:
                linear-gradient(rgba(255, 255, 255, 0.025) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, 0.025) 1px, transparent 1px);
            background-size: 48px 48px;
            mask-image: linear-gradient(to bottom, rgba(0,0,0,.75), transparent 85%);
            pointer-events: none;
            z-index: -3;
        }

        body::after {
            content: "";
            position: fixed;
            inset: 0;
            background:
                linear-gradient(120deg, transparent, rgba(214,168,79,.08), transparent);
            animation: luxurySweep 12s ease-in-out infinite;
            pointer-events: none;
            z-index: -2;
        }

        @keyframes luxurySweep {
            0% { transform: translateX(-100%) skewX(-18deg); opacity: 0; }
            20% { opacity: .9; }
            50% { transform: translateX(100%) skewX(-18deg); opacity: 0; }
            100% { transform: translateX(100%) skewX(-18deg); opacity: 0; }
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes glowPulse {
            0%, 100% {
                box-shadow: 0 0 0 rgba(214, 168, 79, 0);
            }
            50% {
                box-shadow: 0 0 34px rgba(214, 168, 79, 0.28);
            }
        }

        @keyframes floatIcon {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-6px);
            }
        }

        @keyframes borderRotate {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        button,
        input,
        textarea,
        select {
            font-family: inherit;
        }

        .page-shell {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .topbar {
            position: sticky;
            top: 0;
            z-index: 50;
            padding: 14px 22px;
            backdrop-filter: blur(20px);
            background: rgba(7, 7, 7, 0.76);
            border-bottom: 1px solid var(--border);
        }

        .navbar {
            max-width: 1240px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 14px;
            min-width: 250px;
        }

        .brand-mark {
            width: 48px;
            height: 48px;
            border-radius: 18px;
            display: grid;
            place-items: center;
            color: #090704;
            font-size: 25px;
            background:
                linear-gradient(135deg, var(--gold-light), var(--gold), var(--gold-dark));
            box-shadow:
                0 0 0 1px rgba(255, 255, 255, 0.22) inset,
                0 16px 40px rgba(214, 168, 79, 0.28);
            animation: glowPulse 3.6s ease-in-out infinite;
        }

        .brand-copy {
            display: flex;
            flex-direction: column;
            line-height: 1.1;
        }

        .brand-title {
            font-weight: 800;
            letter-spacing: .4px;
            font-size: 15px;
            color: var(--cream);
            text-transform: uppercase;
        }

        .brand-subtitle {
            margin-top: 4px;
            font-size: 12px;
            color: var(--muted);
            letter-spacing: .7px;
        }

        .nav-links {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            flex-wrap: wrap;
            gap: 8px;
        }

        .nav-link,
        .logout-btn {
            position: relative;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            min-height: 42px;
            padding: 10px 13px;
            border-radius: 999px;
            border: 1px solid transparent;
            color: var(--muted);
            background: transparent;
            cursor: pointer;
            font-size: 14px;
            transition:
                transform .22s ease,
                color .22s ease,
                border-color .22s ease,
                background .22s ease,
                box-shadow .22s ease;
        }

        .nav-link:hover,
        .logout-btn:hover {
            color: var(--cream);
            transform: translateY(-2px);
            border-color: rgba(214, 168, 79, .32);
            background: rgba(214, 168, 79, .08);
            box-shadow: 0 10px 22px rgba(0,0,0,.25);
        }

        .nav-link.active {
            color: #12100c;
            background: linear-gradient(135deg, var(--gold-light), var(--gold));
            border-color: rgba(255,255,255,.18);
            font-weight: 700;
        }

        .logout-btn {
            color: #ffd2d2;
        }

        .layout-area {
            width: min(1240px, calc(100% - 34px));
            margin: 28px auto 0;
            display: grid;
            grid-template-columns: 260px minmax(0, 1fr);
            gap: 22px;
            flex: 1;
        }

        .sidebar {
            position: sticky;
            top: 92px;
            align-self: start;
            background:
                linear-gradient(180deg, rgba(26, 21, 17, .88), rgba(13, 11, 9, .88));
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            box-shadow: var(--soft-shadow);
            padding: 18px;
            overflow: hidden;
            animation: fadeUp .6s ease both;
        }

        .sidebar::before {
            content: "";
            position: absolute;
            inset: 0;
            background:
                radial-gradient(circle at top, rgba(214,168,79,.16), transparent 42%);
            pointer-events: none;
        }

        .sidebar-title {
            position: relative;
            margin: 0 0 14px;
            color: var(--gold-light);
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 1.8px;
        }

        .side-menu {
            position: relative;
            display: grid;
            gap: 9px;
        }

        .side-link {
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 12px 13px;
            border-radius: 16px;
            color: var(--muted);
            border: 1px solid transparent;
            transition: .22s ease;
        }

        .side-link:hover,
        .side-link.active {
            color: var(--cream);
            background: rgba(214,168,79,.1);
            border-color: rgba(214,168,79,.24);
            transform: translateX(4px);
        }

        .side-icon {
            width: 34px;
            height: 34px;
            display: grid;
            place-items: center;
            border-radius: 13px;
            background: rgba(214,168,79,.12);
            color: var(--gold-light);
        }

        .main-content {
            min-width: 0;
            animation: fadeUp .75s ease both;
        }

        .content-frame {
            position: relative;
            padding: 2px;
            border-radius: calc(var(--radius-lg) + 2px);
            background: linear-gradient(
                135deg,
                rgba(214,168,79,.48),
                rgba(255,255,255,.04),
                rgba(214,168,79,.22),
                rgba(255,255,255,.03)
            );
            background-size: 260% 260%;
            animation: borderRotate 10s ease infinite;
            box-shadow: var(--shadow);
        }

        .content-inner {
            min-height: 70vh;
            padding: 24px;
            border-radius: var(--radius-lg);
            background:
                linear-gradient(180deg, rgba(18, 15, 12, .94), rgba(9, 8, 7, .96));
            border: 1px solid rgba(255,255,255,.04);
            overflow: hidden;
        }

        .luxury-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 18px;
            margin-bottom: 22px;
            padding: 20px;
            border: 1px solid rgba(214,168,79,.18);
            border-radius: var(--radius-lg);
            background:
                radial-gradient(circle at top left, rgba(214,168,79,.18), transparent 30%),
                linear-gradient(135deg, rgba(255,255,255,.05), rgba(255,255,255,.01));
        }

        .luxury-header h1 {
            margin: 0;
            font-size: clamp(24px, 3vw, 38px);
            color: var(--cream);
            letter-spacing: -.5px;
        }

        .luxury-header p {
            margin: 7px 0 0;
            color: var(--muted);
            max-width: 650px;
        }

        .floating-emblem {
            width: 76px;
            height: 76px;
            flex: 0 0 auto;
            border-radius: 26px;
            display: grid;
            place-items: center;
            font-size: 34px;
            color: #161008;
            background: linear-gradient(135deg, var(--gold-light), var(--gold), var(--gold-dark));
            box-shadow: 0 20px 45px rgba(214,168,79,.22);
            animation: floatIcon 4s ease-in-out infinite;
        }

        .container {
            width: 100%;
        }

        .card {
            position: relative;
            background:
                radial-gradient(circle at top left, rgba(214,168,79,.12), transparent 28%),
                var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 22px;
            margin-bottom: 18px;
            box-shadow: var(--soft-shadow);
            overflow: hidden;
            animation: fadeUp .55s ease both;
        }

        .card::before {
            content: "";
            position: absolute;
            inset: 0;
            background:
                linear-gradient(120deg, transparent, rgba(255,255,255,.04), transparent);
            transform: translateX(-100%);
            transition: transform .7s ease;
            pointer-events: none;
        }

        .card:hover::before {
            transform: translateX(100%);
        }

        .card h1,
        .card h2,
        .card h3 {
            color: var(--cream);
        }

        .card p {
            color: var(--muted);
            line-height: 1.65;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 18px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-height: 42px;
            border: 0;
            border-radius: 999px;
            padding: 11px 17px;
            background:
                linear-gradient(135deg, var(--gold-light), var(--gold), var(--gold-dark));
            color: #120d08;
            font-weight: 800;
            cursor: pointer;
            box-shadow: 0 14px 30px rgba(214,168,79,.18);
            transition:
                transform .22s ease,
                box-shadow .22s ease,
                filter .22s ease;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 18px 38px rgba(214,168,79,.28);
            filter: brightness(1.04);
        }

        .btn-danger {
            background: linear-gradient(135deg, #ff9a9f, #e15b64, #9b1f29);
            color: white;
        }

        .btn-muted {
            background: linear-gradient(135deg, #a9a9a9, #777, #444);
            color: white;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 10px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: .3px;
            border: 1px solid rgba(255,255,255,.1);
        }

        .badge::before {
            content: "●";
            font-size: 9px;
        }

        .pending {
            background: rgba(241,199,93,.16);
            color: #ffe9a9;
            border-color: rgba(241,199,93,.3);
        }

        .approved,
        .available {
            background: rgba(101,214,158,.15);
            color: #b7ffd6;
            border-color: rgba(101,214,158,.3);
        }

        .rejected,
        .unavailable {
            background: rgba(225,91,100,.15);
            color: #ffc4c8;
            border-color: rgba(225,91,100,.3);
        }

        .cancelled {
            background: rgba(180,180,180,.14);
            color: #dedede;
            border-color: rgba(180,180,180,.25);
        }

        input,
        textarea,
        select {
            width: 100%;
            padding: 12px 13px;
            border: 1px solid rgba(214,168,79,.22);
            border-radius: 14px;
            box-sizing: border-box;
            margin-top: 7px;
            color: var(--cream);
            background: rgba(255,255,255,.045);
            outline: none;
            transition:
                border-color .22s ease,
                box-shadow .22s ease,
                background .22s ease;
        }

        input:focus,
        textarea:focus,
        select:focus {
            border-color: rgba(243,216,145,.65);
            box-shadow: 0 0 0 4px rgba(214,168,79,.12);
            background: rgba(255,255,255,.07);
        }

        input::placeholder,
        textarea::placeholder {
            color: rgba(248,234,210,.42);
        }

        label {
            font-weight: 800;
            display: block;
            margin-top: 14px;
            color: var(--gold-light);
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: transparent;
            overflow: hidden;
            border-radius: var(--radius-md);
        }

        th {
            color: var(--gold-light);
            background: rgba(214,168,79,.09);
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: .9px;
        }

        th,
        td {
            padding: 14px;
            border-bottom: 1px solid rgba(255,255,255,.075);
            text-align: left;
            vertical-align: top;
        }

        td {
            color: var(--muted);
        }

        tr:hover td {
            background: rgba(255,255,255,.025);
            color: var(--cream);
        }

        .alert {
            position: relative;
            padding: 15px 16px 15px 48px;
            border-radius: 18px;
            margin-bottom: 18px;
            border: 1px solid rgba(255,255,255,.08);
            box-shadow: var(--soft-shadow);
            animation: fadeUp .4s ease both;
        }

        .alert::before {
            position: absolute;
            left: 17px;
            top: 14px;
            font-size: 18px;
        }

        .success {
            background: rgba(101,214,158,.13);
            color: #ccffe2;
            border-color: rgba(101,214,158,.24);
        }

        .success::before {
            content: "✓";
        }

        .error {
            background: rgba(225,91,100,.14);
            color: #ffd5d8;
            border-color: rgba(225,91,100,.25);
        }

        .error::before {
            content: "!";
        }

        .muted {
            color: var(--muted);
        }

        .actions form {
            display: inline;
        }

        .page-footer {
            width: min(1240px, calc(100% - 34px));
            margin: 22px auto;
            padding: 18px 22px;
            color: var(--muted);
            border: 1px solid rgba(214,168,79,.16);
            border-radius: var(--radius-lg);
            background: rgba(10,8,7,.68);
            display: flex;
            justify-content: space-between;
            gap: 14px;
            flex-wrap: wrap;
        }

        .footer-highlight {
            color: var(--gold-light);
            font-weight: 800;
        }

        .mobile-admin-menu {
            display: none;
            margin-bottom: 18px;
        }

        .mobile-admin-menu .side-menu {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(170px, 1fr));
        }

        @media (max-width: 980px) {
            .layout-area {
                grid-template-columns: 1fr;
            }

            .sidebar {
                display: none;
            }

            .mobile-admin-menu {
                display: block;
            }

            .navbar {
                align-items: flex-start;
            }

            .brand {
                min-width: unset;
            }
        }

        @media (max-width: 720px) {
            .topbar {
                padding: 12px;
            }

            .navbar {
                flex-direction: column;
            }

            .nav-links {
                justify-content: flex-start;
                width: 100%;
            }

            .layout-area {
                width: min(100% - 20px, 1240px);
                margin-top: 16px;
            }

            .content-inner {
                padding: 16px;
            }

            .luxury-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .floating-emblem {
                width: 62px;
                height: 62px;
                font-size: 28px;
            }

            table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }

            .page-footer {
                width: min(100% - 20px, 1240px);
            }
        }

        @media print {
            body {
                background: white;
                color: black;
            }

            .topbar,
            .sidebar,
            .mobile-admin-menu,
            .page-footer {
                display: none;
            }

            .layout-area,
            .content-frame,
            .content-inner {
                width: 100%;
                margin: 0;
                padding: 0;
                box-shadow: none;
                border: 0;
                background: white;
                color: black;
            }

            .card {
                box-shadow: none;
                border: 1px solid #ddd;
                background: white;
                color: black;
            }
        }

    </style>
    @stack('styles')
</head>

<body>
<div class="page-shell">
    <header class="topbar">
        <nav class="navbar">
            <a href="{{ route('home') }}" class="brand">
                <span class="brand-mark">✦</span>
                <span class="brand-copy">
                    <span class="brand-title">Mantilla Funeral</span>
                    <span class="brand-subtitle">Reservation System</span>
                </span>
            </a>

            <div class="nav-links">
                <a href="{{ route('home') }}"
                   class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                    <span>🏛️</span>
                    <span>Home</span>
                </a>

                <a href="{{ route('services.index') }}"
                   class="nav-link {{ request()->routeIs('services.*') ? 'active' : '' }}">
                    <span>🕊️</span>
                    <span>Services</span>
                </a>

                @auth
                    <a href="{{ route('dashboard') }}"
                       class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <span>📊</span>
                        <span>Dashboard</span>
                    </a>

                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}"
                           class="nav-link {{ request()->routeIs('admin.*') ? 'active' : '' }}">
                            <span>👑</span>
                            <span>Admin Panel</span>
                        </a>
                    @else
                        <a href="{{ route('reservations.index') }}"
                           class="nav-link {{ request()->routeIs('reservations.*') ? 'active' : '' }}">
                            <span>📜</span>
                            <span>My Reservations</span>
                        </a>
                    @endif

                    <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                        @csrf
                        <button type="submit" class="logout-btn">
                            <span>🚪</span>
                            <span>Logout</span>
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}"
                       class="nav-link {{ request()->routeIs('login') ? 'active' : '' }}">
                        <span>🔐</span>
                        <span>Login</span>
                    </a>

                    <a href="{{ route('register') }}"
                       class="nav-link {{ request()->routeIs('register') ? 'active' : '' }}">
                        <span>✨</span>
                        <span>Register</span>
                    </a>
                @endauth
            </div>
        </nav>
    </header>

    <div class="layout-area">
        @auth
            @if(auth()->user()->role === 'admin')
                <aside class="sidebar">
                    <h3 class="sidebar-title">Admin Navigation</h3>

                    <div class="side-menu">
                        <a href="{{ route('admin.dashboard') }}"
                           class="side-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <span class="side-icon">📊</span>
                            <span>Dashboard</span>
                        </a>

                        <a href="{{ route('admin.services.index') }}"
                           class="side-link {{ request()->routeIs('admin.services.*') ? 'active' : '' }}">
                            <span class="side-icon">🕊️</span>
                            <span>Manage Services</span>
                        </a>

                        <a href="{{ route('admin.reservations.index') }}"
                           class="side-link {{ request()->routeIs('admin.reservations.*') ? 'active' : '' }}">
                            <span class="side-icon">📋</span>
                            <span>Reservation Requests</span>
                        </a>

                        <a href="{{ route('admin.clients.index') }}"
                           class="side-link {{ request()->routeIs('admin.clients.*') ? 'active' : '' }}">
                            <span class="side-icon">👥</span>
                            <span>Client Records</span>
                        </a>

                        <a href="{{ route('admin.reports.index') }}"
                           class="side-link {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}">
                            <span class="side-icon">📈</span>
                            <span>System Reports</span>
                        </a>
                    </div>
                </aside>
            @else
                <aside class="sidebar">
                    <h3 class="sidebar-title">Client Menu</h3>

                    <div class="side-menu">
                        <a href="{{ route('dashboard') }}"
                           class="side-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                            <span class="side-icon">🏠</span>
                            <span>My Dashboard</span>
                        </a>

                        <a href="{{ route('services.index') }}"
                           class="side-link {{ request()->routeIs('services.*') ? 'active' : '' }}">
                            <span class="side-icon">🕊️</span>
                            <span>View Services</span>
                        </a>

                        <a href="{{ route('reservations.index') }}"
                           class="side-link {{ request()->routeIs('reservations.*') ? 'active' : '' }}">
                            <span class="side-icon">📜</span>
                            <span>My Reservations</span>
                        </a>
                    </div>
                </aside>
            @endif
        @else
            <aside class="sidebar">
                <h3 class="sidebar-title">Welcome</h3>

                <div class="side-menu">
                    <a href="{{ route('home') }}"
                       class="side-link {{ request()->routeIs('home') ? 'active' : '' }}">
                        <span class="side-icon">🏛️</span>
                        <span>Home</span>
                    </a>

                    <a href="{{ route('services.index') }}"
                       class="side-link {{ request()->routeIs('services.*') ? 'active' : '' }}">
                        <span class="side-icon">🕊️</span>
                        <span>Available Services</span>
                    </a>

                    <a href="{{ route('login') }}"
                       class="side-link {{ request()->routeIs('login') ? 'active' : '' }}">
                        <span class="side-icon">🔐</span>
                        <span>Login</span>
                    </a>

                    <a href="{{ route('register') }}"
                       class="side-link {{ request()->routeIs('register') ? 'active' : '' }}">
                        <span class="side-icon">✨</span>
                        <span>Create Account</span>
                    </a>
                </div>
            </aside>
        @endauth

        <main class="main-content">
            @auth
                @if(auth()->user()->role === 'admin')
                    <section class="mobile-admin-menu card">
                        <h3 class="sidebar-title">Admin Navigation</h3>

                        <div class="side-menu">
                            <a href="{{ route('admin.dashboard') }}" class="side-link">
                                <span class="side-icon">📊</span>
                                <span>Dashboard</span>
                            </a>

                            <a href="{{ route('admin.services.index') }}" class="side-link">
                                <span class="side-icon">🕊️</span>
                                <span>Services</span>
                            </a>

                            <a href="{{ route('admin.reservations.index') }}" class="side-link">
                                <span class="side-icon">📋</span>
                                <span>Reservations</span>
                            </a>

                            <a href="{{ route('admin.clients.index') }}" class="side-link">
                                <span class="side-icon">👥</span>
                                <span>Clients</span>
                            </a>

                            <a href="{{ route('admin.reports.index') }}" class="side-link">
                                <span class="side-icon">📈</span>
                                <span>Reports</span>
                            </a>
                        </div>
                    </section>
                @endif
            @endauth

            <section class="luxury-header">
                <div>
                    <h1>{{ $title ?? 'Mantilla Funeral Reservation System' }}</h1>
                    <p>
                        A dignified and organized web-based reservation platform for funeral service
                        scheduling, client assistance, and administrative management.
                    </p>
                </div>

                <div class="floating-emblem">
                    🕯️
                </div>
            </section>

            @if(session('success'))
                <div class="alert success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert error">
                    {{ session('error') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert error">
                    <strong>Please check the form errors:</strong>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="content-frame">
                <div class="content-inner">
                    @yield('content')
                </div>
            </div>
        </main>
    </div>

    <footer class="page-footer">
        <div>
            <span class="footer-highlight">Mantilla Funeral Reservation System</span>
            <span>— dignified service management platform.</span>
        </div>

        <div>
            © {{ date('Y') }} All Rights Reserved
        </div>
    </footer>
</div>

@stack('scripts')
</body>
</html>