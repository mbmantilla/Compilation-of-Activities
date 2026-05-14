<!DOCTYPE html>
<html>
<head>
    <title>ML Hero Roles & Playstyle System</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;600&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: radial-gradient(circle at top, #020617, #000814);
            color: #e2e8f0;
            margin: 0;
        }

        /* HEADER (GAME STYLE) */
        header {
            font-family: 'Orbitron', sans-serif;
            background: linear-gradient(90deg, #020617, #0f172a);
            padding: 20px;
            text-align: center;
            font-size: 26px;
            color: #38bdf8;
            letter-spacing: 2px;
            box-shadow: 0 0 15px #38bdf8;
        }

        /* CONTAINER */
        .container {
            padding: 30px;
            max-width: 1200px;
            margin: auto;
        }

        /* GRID */
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            justify-items: center;
        }

        /* CARD (GAME STYLE) */
        .card {
            background: linear-gradient(145deg, #020617, #1e293b);
            padding: 15px;
            border-radius: 15px;
            text-align: center;
            transition: 0.3s;
            width: 300px;
            border: 1px solid rgba(56,189,248,0.2);
            box-shadow: 0 0 10px rgba(56,189,248,0.2);
        }

        .card:hover {
            transform: translateY(-8px) scale(1.05);
            box-shadow: 0 0 20px #38bdf8;
        }

        /* IMAGES */
        .hero-img {
            width: 120px;
            border-radius: 10px;
            margin-bottom: 10px;
            border: 2px solid #38bdf8;
        }

        .hero-img-large {
            width: 260px;
            border-radius: 15px;
            margin-bottom: 15px;
            border: 3px solid #38bdf8;
            box-shadow: 0 0 15px #38bdf8;
        }

        /* TITLE */
        .hero-title {
            text-align: center;
            margin-bottom: 20px;
            font-size: 28px;
            font-family: 'Orbitron', sans-serif;
            color: #38bdf8;
        }

        /* DETAIL CARD */
        .detail-card {
            max-width: 500px;
            margin: auto;
            background: linear-gradient(145deg, #020617, #1e293b);
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(56,189,248,0.3);
        }

        .hero-info {
            text-align: left;
            margin: 15px 0;
        }

        /* BUTTON */
        .btn {
            display: inline-block;
            padding: 10px 15px;
            background: linear-gradient(90deg, #38bdf8, #0ea5e9);
            color: black;
            border-radius: 8px;
            margin-top: 10px;
            font-weight: 600;
            transition: 0.3s;
            box-shadow: 0 0 10px rgba(56,189,248,0.5);
        }

        .btn:hover {
            transform: scale(1.1);
            box-shadow: 0 0 20px #38bdf8;
        }

        /* SEARCH */
        .search-box {
            text-align: center;
            margin-bottom: 25px;
        }

        .search-box input {
            padding: 10px;
            border-radius: 8px;
            border: none;
            width: 220px;
            background: #020617;
            color: #fff;
            border: 1px solid #38bdf8;
        }

        .search-box button {
            padding: 10px 15px;
            border: none;
            background: #38bdf8;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
        }

        /* BADGE */
        .badge {
            background: #38bdf8;
            padding: 5px 10px;
            border-radius: 6px;
            color: black;
            font-size: 12px;
            font-weight: bold;
        }

        /* FOOTER */
        footer {
            text-align: center;
            padding: 15px;
            margin-top: 30px;
            font-size: 13px;
            color: #94a3b8;
        }

    </style>
</head>

<body>

<header>
    ⚔️ ML HERO SYSTEM ⚔️
</header>

<div class="container">
    @yield('content')
</div>

<footer>
    © 2026 Mobile Legends System | Laravel Project
</footer>

</body>
</html>