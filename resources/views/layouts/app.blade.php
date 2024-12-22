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

        <!-- Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            .full_window {
                min-height: 100%;
            }
            .main_menu {
                position: fixed;
                top: 0;
                left: 0;
                min-height: 65px;
                max-height: 65px;
                width: 100%;
                z-index: 1000;
                align-items: center;
            }

            .header_block {
                position: fixed;
                top: 65px;
                left: 0;
                min-height: 9%;/*100px;*/
                max-height: 9%;/*100px;*/
                width: 100%;
                z-index: 999;
                align-items: center;
                background: white;
            }

            /* A fő tartalom */
            .main_block {
                margin-top: 165px;
                padding: 20px;
                min-height: calc(593px);
                font-size: 14px;
            }

            form input {
                font-size: 14px;
            }

            .footer_block {
                width: 100%;
                background-color: #f8f9fa;
                /*padding-top: 10px;*/
            }

            .footer-paginator {
                min-height: 65px;
                background-color: #e9ecef;
                /*display: flex;*/
                justify-content: center;
                align-items: center;
                font-size: 18px;
                font-weight: bold;
                color: #333;
            }

            /* Dinamikus tartalom blokk */
            .footer-top {
                min-height: 65px;
                max-height: 65px;
                background-color: #e9ecef;
                display: flex;
                justify-content: center;
                align-items: center;
                font-size: 14px;
                font-weight: bold;
                color: #333;
            }
            /*footer-top elem:*/
            .alert-success {
                justify-content: center;
                align-items: center;
                width: 100vw;
            }
            input, textarea, select {
                font-size: 14px;
            }

            /* Copyright blokk */
            .footer-bottom {
                min-height: 65px;
                text-align: center;
                padding: 10px 0;
                background-color: #343a40;
                color: #fff;
                font-size: 14px;
            }


        </style>

    </head>
    <body class="font-sans antialiased">
        <div class="bg-gray-100 full_window">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="header_block max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="main_block">
                {{ $slot }}
            </main>

            <!-- Footer -->
            <footer class="footer_block">
                <!-- paginator -->
                <div class="footer-paginator">
                    @yield('footer-paginator')
                </div>
                <!-- Dinamikusan kitölthető blokk -->
                <div class="footer-top">
                    @yield('footer-top')
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                </div>

                <!-- Copyright rész -->
                <div class="footer-bottom">
                    <p>&copy; {{ date('Y') }} {{ config('app.name') }}. Minden jog fenntartva.</p>
                </div>
            </footer>

        </div>

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

    </body>
</html>
