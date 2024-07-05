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
            z-index: -1;
            top: -10%;
            left: -10%;
            width: 120%;
            height: 120%;
            background-image: url("{{ asset('assets/bg.jpg') }}");
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;

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

background: rgb(190,196,192);
background: linear-gradient(180deg, rgba(190,196,192,1) 36%, rgba(246,247,249,1) 100%);
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
            z-index: 1;
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
            margin-top: 80px;
             /* Ensure content starts below the navbar */


        }
        .logout_name {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    padding: 10px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    margin-top: 10px;
}

.logout_name .profile_name {
    font-weight: bold;
    font-size: 18px;
    margin-right: 10px;
color:black;
}

.logout_name .job {
    font-size: 14px;
    color: #666;
    margin-right: 10px;
}

.logout_name a {
    display: flex;
    align-items: center;
    text-decoration: none;
    color: #333;
    font-size: 16px;
    cursor: pointer;
}

a:hover {
    color: #007bff;
}

.bx-log-out {
    margin-right: 5px;
    font-size: 20px;
}
.nav-links {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 20px;
    height: 70px;
    background-color: transparent; /* Same background color as the body */
    list-style: none; /* Removing default list styling */
    left:0;
    padding: 0;
    margin-left:1.5rem;
}

.nav-link {
    color: #1A2027;
    text-decoration: none;
    font-size: 18px;
    font-family: 'Euclid Circular A', 'Poppins', sans-serif;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0 7px;
    position: relative;
    height: 100%;
    transition: color 0.3s ease-in-out;


}

.nav-link::before {
    content: "";

    position: absolute;
    width: 100%;
    height: 3px;
    bottom: 3px;
    left: 0;
    background-color: #3e95ff;
    transition: all 0.2s ease-in-out;
    transform: scale(0);
    visibility: hidden;
}

.nav-link:hover {
    color: #3e95ff;
}

.nav-link:hover::before {
    transform: scale(1);
    visibility: visible;
}

.nav-link:hover .submenu {
    height: 85px;
}

.submenu {
    overflow: hidden;
    position: absolute;
    left: 0;
    display: flex;
    justify-content: center;
    align-items: stretch;
    width: 100%;
    background-color: #3e95ff;
    height: 0;
    line-height: 40px;
    box-sizing: border-box;
    transition: height 0.3s ease-in-out;
}

.nav-link .submenu a {
    color: #fff;
    opacity: 0;
    font-size: 16px;
    transition: opacity 0.25s;
}

.nav-link:hover .submenu a {
    opacity: 1;
}

.nav-link .submenu a:hover {
    background: rgb(0 0 0 / 20%);
}
.nav-container{
    display:flex;
    margin-top:5px;

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

    <nav class="navbar"><div class="nav-container">
        <img class="navbar-logo" src="{{ asset('assets/logo.png') }}" />

        <div class="nav-links">

        <a class="nav-link" href="{{ route('admin.users.index') }}" style=@yield('hide')>Users</a>


            <a class="nav-link" href=@yield('routeprospects')>Prospects</a>
        </div></div>
<div class="logout_name">
    <div style="margin-right:25px;">
        <div class="profile_name">@yield('profilename')</div>
        <div class="job">@yield('role')</div>
        <form id="logoutForm" action="{{ route('logout') }}" method="POST" style="display: none;">
</div>
    @csrf
</form>

<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logoutForm').submit();">

<i class='bx bx-log-out'><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" color="#000000" fill="none">
    <path d="M15 17.625C14.9264 19.4769 13.3831 21.0494 11.3156 20.9988C10.8346 20.987 10.2401 20.8194 9.05112 20.484C6.18961 19.6768 3.70555 18.3203 3.10956 15.2815C3 14.723 3 14.0944 3 12.8373L3 11.1627C3 9.90561 3 9.27705 3.10956 8.71846C3.70555 5.67965 6.18961 4.32316 9.05112 3.51603C10.2401 3.18064 10.8346 3.01295 11.3156 3.00119C13.3831 2.95061 14.9264 4.52307 15 6.37501" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
    <path d="M21 12H10M21 12C21 11.2998 19.0057 9.99153 18.5 9.5M21 12C21 12.7002 19.0057 14.0085 18.5 14.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
</svg></i>
</a></div>
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
