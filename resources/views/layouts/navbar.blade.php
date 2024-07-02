<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        * {
            box-sizing: border-box;
        }

        button {
            border: 0;
            padding: 0;
            background: transparent;
            cursor: pointer;
        }

        .navbar,
        .navbar-burger,
        .menu,
        .background {
            position: fixed;
        }

        .background {
            z-index: 0;
            top: -10%;
            left: -10%;
            width: 120%;
            height: 120%;
            background-image: url("{{ asset('assets/bg.png') }}");
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            transition: 0.5s;
        }

        body.open .background {
            filter: blur(50px);
        }

        .navbar {
            z-index: 1;
            top: 0;
            left: 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            height: 72px;
            padding-left: 20px;
            padding-right: 72px;
             /* Adjusted background color with opacity */
            backdrop-filter: blur(7px); /* Apply blur to the background */
            color: #f9f9f9;
            transition: background-color 0.5s ease; /* Smooth transition for background color */
        }

        .navbar > button {
            font-size: 28px;
        }

        .navbar-logo {
            height: 50px;
        }

        .navbar-burger {
            z-index: 3;
            top: 0;
            right: 0;
            display: grid;
            place-items: center;
            width: 72px;
            height: 72px;
            background-image: url("{{ asset('assets/menu.svg') }}");
            background-repeat: no-repeat;
            background-position: center;
        }

        body.open .navbar-burger {
            background-image: url("{{ asset('assets/close.svg') }}");
        }

        .navbar-search {
            border: 0;
            height: 40px;
            background: #2f3339 url("{{ asset('assets/search.svg') }}");
            background-repeat: no-repeat;
            background-position: 10px 50%;
            border: 0;
            border-radius: 6px;
            padding-left: 36px;
            width: 180px;
            font-size: 16px;
            font-family: "Euclid Circular A";
        }

        .navbar-search::placeholder {
            color: #a7a7a7;
        }

        .menu {
            z-index: 2;
            top: 0;
            left: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 32px;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            opacity: 0;
            visibility: hidden;
            transition: 0.5s;
        }

        body.open .menu {
            opacity: 1;
            visibility: visible;
        }

        .menu > a {
            color: #f9f9f9;
            font-size: 32px;
            font-family: "Euclid Circular A";
            text-decoration: none;
        }

        body.open .menu > a {
            animation: appear 0.3s both;
        }

        @keyframes appear {
            0% {
                opacity: 0;
                translate: 0 50px;
            }
            100% {
                opacity: 1;
            }
        }
        .content {
            margin-top: 72px;
             /* Ensure content starts below the navbar */


        }
    </style>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Navbar 1</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap"
        rel="stylesheet"
    />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined"
        rel="stylesheet"
    />
    <link href="{{ asset('assets/style.css') }}" rel="stylesheet" />
</head>
<body>
    <div class="background"></div>
    <nav class="navbar">
        <img class="navbar-logo" src="{{ asset('assets/logo.png') }}" />

    </nav>
    <button class="navbar-burger" onclick="toggleMenu()"></button>
    <nav class="menu">
        <a href="#" style="animation-delay: 0.1s">Home</a>
        <a href="#" style="animation-delay: 0.2s">About</a>
        <a href="#" style="animation-delay: 0.3s">Services</a>
        <a href="#" style="animation-delay: 0.4s">Products</a>
        <a href="#" style="animation-delay: 0.5s">Contact</a>
    </nav>
    <div class="content">
        @yield('content')
    </div>

    <script type="text/javascript">
        const toggleMenu = () => {
            document.body.classList.toggle("open");
        };
    </script>
</body>
</html>
