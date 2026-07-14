<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Kütüphane Sistemi')</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #f5f5f5;
            color: #333;
            line-height: 1.6;
        }

        nav {
            background-color: #2c3e50;
            padding: 0 1.5rem;
        }

        nav ul {
            list-style: none;
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        nav a {
            display: block;
            color: #ecf0f1;
            text-decoration: none;
            padding: 1rem 1.25rem;
            font-size: 0.95rem;
        }

        nav a:hover,
        nav a.active {
            background-color: #34495e;
        }

        main {
            max-width: 1100px;
            margin: 2rem auto;
            padding: 0 1.5rem;
        }

        h1 {
            margin-bottom: 1.5rem;
            color: #2c3e50;
        }

        h2 {
            margin: 2rem 0 1rem;
            color: #34495e;
            font-size: 1.25rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            margin-bottom: 1.5rem;
        }

        th,
        td {
            padding: 0.75rem 1rem;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #34495e;
            color: #fff;
            font-weight: 600;
        }

        tr:hover td {
            background-color: #f9f9f9;
        }

        .durum-aktif {
            color: #e67e22;
            font-weight: 600;
        }

        .durum-iade {
            color: #27ae60;
            font-weight: 600;
        }

        .bos-kayit {
            background-color: #fff;
            padding: 1rem;
            color: #777;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .mesaj {
            padding: 0.75rem 1rem;
            margin-bottom: 1rem;
            border-radius: 4px;
        }

        .mesaj-basari {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .mesaj-hata {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .ust-arac {
            margin-bottom: 1rem;
        }

        .btn {
            display: inline-block;
            padding: 0.5rem 1rem;
            background-color: #ecf0f1;
            color: #2c3e50;
            text-decoration: none;
            border: 1px solid #bdc3c7;
            border-radius: 4px;
            font-size: 0.9rem;
            cursor: pointer;
        }

        .btn-birincil {
            background-color: #3498db;
            color: #fff;
            border-color: #2980b9;
        }

        .btn-tehlike {
            background-color: #e74c3c;
            color: #fff;
            border-color: #c0392b;
        }

        .btn-kucuk {
            padding: 0.35rem 0.75rem;
            font-size: 0.85rem;
        }

        .btn:hover {
            opacity: 0.9;
        }

        .islem-hucre {
            white-space: nowrap;
        }

        .inline-form {
            display: inline;
        }

        .form {
            background-color: #fff;
            padding: 1.5rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            max-width: 600px;
        }

        .form-grup {
            margin-bottom: 1rem;
        }

        .form-grup label {
            display: block;
            margin-bottom: 0.35rem;
            font-weight: 600;
        }

        .form-grup input,
        .form-grup textarea,
        .form-grup select {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 1rem;
        }

        .form-hata {
            display: block;
            color: #c0392b;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        .zorunlu {
            color: #e74c3c;
        }

        .form-aksiyon {
            display: flex;
            gap: 0.5rem;
            margin-top: 1.5rem;
        }
    </style>
</head>
<body>
    <nav>
        <ul>
            <li><a href="{{ route('raporlar.index') }}" @class(['active' => request()->routeIs('raporlar.index')])>Raporlar</a></li>
            <li><a href="{{ route('kategoriler.index') }}" @class(['active' => request()->routeIs('kategoriler.*')])>Kategoriler</a></li>
            <li><a href="{{ route('uyeler.index') }}" @class(['active' => request()->routeIs('uyeler.*')])>Üyeler</a></li>
            <li><a href="{{ route('kitaplar.index') }}" @class(['active' => request()->routeIs('kitaplar.*')])>Kitaplar</a></li>
            <li><a href="{{ route('oduncler.index') }}" @class(['active' => request()->routeIs('oduncler.*')])>Ödünçler</a></li>
        </ul>
    </nav>

    <main>
        @yield('content')
    </main>
</body>
</html>
