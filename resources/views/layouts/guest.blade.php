<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Figtree', sans-serif;
            background-color: white;
            color: #333;
        }

        .min-h-screen {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: white;
        }

        .login-container {
            display: flex;
            width: 100%;
            max-width: 1200px;
            height: 100%;
        }

        .login-image {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .login-form {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .form-container {
            width: 100%;
            max-width: 400px;
            padding: 2rem;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        #body1{
            background-color: white;
        }
    </style>
</head>
<body class="font-sans text-gray-900 antialiased"  id="body1">
    <div class="min-h-screen">
        <div class="login-container">
            <div class="login-image">
                <img src="{{ asset('images/login.jpg') }}" alt="Login Image">
            </div>

            <div class="login-form">
                <div class="form-container">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</body>
</html>
