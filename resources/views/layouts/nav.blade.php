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


          <!--Font-->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@100;900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;1,100&display=swap"
    rel="stylesheet">

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
                        <img src="img/deliveboo.svg" alt="">
                    </div>
                </div>
            </div>
        </div>

        <main class="">
            @yield('content')
        </main>
    </div>
</body>

</html>

<style lang="scss" scoped>
    img {
        width: 500px
    }

</style>
