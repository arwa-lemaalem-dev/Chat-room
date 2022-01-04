<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Chat</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <style>
    /* .list-group {
        overflow-y: scroll;
        height: 100%;
        padding-right: 5px;
    } */
    * {
        box-sizing: border-box;
    }

    body {
        /* background-color: #edeff2; */
        font-family: "Calibri", "Roboto", sans-serif;
    }
    /* conversations */
    .chat_window {
        max-width: 100%;
        margin-top: -1.5%;
        overflow: hidden;
    }

    .messages {
        position: relative;
        list-style: none;
        padding: 20px 10px 0 10px;
        height: 500px;
        overflow: scroll;
    }

    .messages .message {
        clear: both;
        overflow: hidden;
        margin-bottom: 20px;
        transition: all 0.5s linear;
        opacity: 0;
    }

    .bottom_wrapper {
        position: relative;
        width: 100%;
        background-color: white;
        padding-left: 20px;
        padding-right: 20px;
        margin-top: -40px;
        /* position: absolute; */
        bottom: 0;
    }

    .bottom_wrapper .message_input_wrapper {
        display: inline-block;
        height: 50px;
        border-radius: 25px;
        border: 1px solid #bcbdc0;
        width: calc(100% - 160px);
        position: relative;
        padding: 0 20px;
        margin-top: 5px
    }

    .bottom_wrapper .message_input_wrapper .message_input {
        border: none;
        height: 100%;
        box-sizing: border-box;
        width: calc(100% - 40px);
        outline-width: 0;
        color: gray;
    }

    .bottom_wrapper .send_message {
        margin-top: 5px;
        width: 140px;
        height: 50px;
        display: inline-block;
        border-radius: 50px;
        background-color: #a3d063;
        border: 2px solid #a3d063;
        color: #fff;
        cursor: pointer;
        transition: all 0.2s linear;
        text-align: center;
        float: right;
    }

    .bottom_wrapper .send_message:hover {
        color: #a3d063;
        background-color: #fff;
    }

    .bottom_wrapper .send_message .text {
        font-size: 18px;
        font-weight: 300;
        display: inline-block;
        line-height: 48px;
    }


    /* width */
    ::-webkit-scrollbar {
        width: 3px;
    }

    /* Track */
    ::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    /* Handle */
    ::-webkit-scrollbar-thumb {
        background: #888;
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
        background: #555;
    }

    /* listUser */
    .users a {
        text-decoration: none !important;
        display: block;
        margin-bottom: 0;
        color: #555
    }


    .users .item {
        padding: 20px
    }

    .users .item .image {
        min-width: 50px;
        max-width: 50px;
        height: 50px;
        margin-right: 15px
    }

    .users .item img {
        padding: 3px;
        border: 1px solid #28a745
    }

    .users .item h3 {
        color: #555;
        font-weight: 400;
        margin-bottom: 0
    }

    .icon {
        float: right;
        color:black;
    }

    /* typing */
    .badge{
        margin-left:45%
    }
    </style>

</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @endif

                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
<script>