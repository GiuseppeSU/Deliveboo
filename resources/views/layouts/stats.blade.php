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
    @vite(['resources/js/mychart.js'])

</head>

<body id="body-stats">
    <div id="app">
        @include('partials.header')
        <div class="container_nav">

            <div class="container">
                <div class="row">
                    <div class="col d-flex justify-content-center">
                        <img src="{{asset('img/deliveboo.svg')}}" alt="">
                    </div>
                </div>
            </div>
        </div>

        <main class="">
            @yield('content')
            <br>
            <div class="d-flex justify-content-center" id="torna_indietro">
                <a href="{{ url('admin') }}" class="btn btn-primary">Torna indietro</a>
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





