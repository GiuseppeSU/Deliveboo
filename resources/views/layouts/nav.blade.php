<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- ICONS Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])
</head>

<body>
    <div id="app">
        @include('partials.header')
        <div class="container_nav">

            <div class="container">
                <div class="row">
                    <div class="col d-flex justify-content-center">
                        <img src="img/deliveboo.png" alt="">
                    </div>
                </div>
            </div>
        </div>

        <main class="container">
            <div class="row">
                @auth
                    <div class="col-3">
                        @include('partials.sidebar')
                    </div>
                    <div class="col-9">
                        @yield('content')
                    </div>
                @endauth
                @guest
                    <div class="col-12">
                        @yield('content')
                    </div>
                @endguest


            </div>

        </main>
    </div>
</body>

</html>

<style lang="scss" scoped>
    img {
        width: 500px
    }
</style>
