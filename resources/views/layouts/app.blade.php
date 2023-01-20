<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link href="https://unpkg.com/nes.css@2.3.0/css/nes.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.rtl.min.css"
        integrity="sha384-DOXMLfHhQkvFFp+rWTZwVlPVqdIhpDVYT9csOnHSgWQWPX0v5MCGtjCJbY6ERspU" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @stack('styles')
</head>

<body>
    <x-alert />
    <div id="nescss">
        <header>
            <nav class="navbar bg-light">
                <div class="container">
                    <div class="nav-brand bg-light">
                        <a href="https://nostalgic-css.github.io/NES.css/">
                            <h1><i class="snes-jp-logo brand-logo"></i>Retro-Donation</h1>
                        </a>
                        <p>Bridge interaction with your audience!.</p>
                    </div>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                            @auth
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page"
                                    href="{{ route('dashboard') }}">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="{{ route('profile') }}">Profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                            </li>
                            @endauth
                            @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Login</a>
                            </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        @yield('content')
        <footer>
            <p><span>©{{ date('Y') }}</span>
                <a href="https://kuroeveryday.blogspot.com/" target="_blank" rel="noopener">Retro Donation By</a>
                <span>-</span>
                <a href="https://twitter.com/bc_rikko" target="_blank" rel="noopener"></a>@Muhamad.tsx
            </p>
        </footer>
        <button type="button" class="nes-btn is-error scroll-btn active"><span>&lt;</span></button>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM="
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"
        integrity="sha256-yE5LLp5HSQ/z+hJeCqkz9hdjNkk1jaiGG0tDCraumnA=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        })
        $(document).ready(function() {
            const state = $("#alert-data-success").data("status"); //getter
            if (state) {
                Swal.fire({
                    icon: "success",
                    title: 'Success!',
                    text: state,
                });
            }

            const stateError = $("#alert-data-error").data("status"); //getter
            if (stateError) {
                Swal.fire({
                    icon: "error",
                    title: 'Failed!',
                    text: stateError,
                });
            }

            $('.money-mask').mask('000.000.000', {
                reverse: true
            });
        })

        const ajaxRequest = (data = null, route, method = 'post') => {
            return new Promise((resolve, reject) => {
                $.ajax({
                    url: route,
                    type: method,
                    dataType: 'json',
                    data: data,
                    success: function(response) {
                        if (response.success) {
                            resolve(response)
                        } else {
                            reject(response)
                        }
                    },
                    error: function(err) {
                        reject(err)
                    }
                });
            })
        }
    </script>
    @stack('scripts')
</body>

</html>
