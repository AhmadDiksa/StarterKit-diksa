<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita - @yield('title')</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        body {
            display: flex;
            min-height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f9fafb;
        }
        .sidebar {
            width: 250px;
            background-color: #1f2937;
            color: white;
            padding: 20px;
            box-sizing: border-box;
        }
        .sidebar h2 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            font-weight: bold;
        }
        .sidebar ul {
            list-style: none;
            padding-left: 0;
        }
        .sidebar ul li {
            margin-bottom: 1rem;
        }
        .sidebar ul li a {
            color: #d1d5db;
            text-decoration: none;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 12px;
            border-radius: 6px;
            transition: background-color 0.2s ease;
        }
        .sidebar ul li a:hover, .sidebar ul li a.active {
            background-color: #374151;
            color: white;
        }
        .content {
            flex-grow: 1;
            padding: 30px;
            box-sizing: border-box;
        }
    </style>
</head>
<body>
    <nav class="sidebar">
        <h2>Menu Berita</h2>
        <ul>
            <li>
                <a href="{{ route('berita.create') }}" class="{{ request()->routeIs('berita.create') ? 'active' : '' }}">
                    <i class="fas fa-pen"></i> Tulis Berita Baru
                </a>
            </li>
            <li>
                <a href="{{ route('berita.index') }}" class="{{ request()->routeIs('berita.index') ? 'active' : '' }}">
                    <i class="fas fa-list"></i> Daftar Berita
                </a>
            </li>
        </ul>
    </nav>
    <main class="content">
        @yield('content')
    </main>
</body>
</html>
