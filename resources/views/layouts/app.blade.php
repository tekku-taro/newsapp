<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title> @yield('title') </title>
    <link rel="stylesheet" href="{{ asset('/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora">
    <link rel="stylesheet" href="{{ asset('/fonts/fontawesome-all.min.css')}}">
    <link rel="stylesheet" href="{{ asset('/fonts/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ asset('/fonts/fontawesome5-overrides.min.css')}}">
    <link rel="stylesheet" href="{{ asset('/css/Article-Clean.css')}}">
    <link rel="stylesheet" href="{{ asset('/css/Article-List.css')}}">
    <link rel="stylesheet" href="{{ asset('/css/Contact-Form-Clean.css')}}">
    <link rel="stylesheet" href="{{ asset('/css/styles.css')}}">

    <script src="https://cdn.jsdelivr.net/npm/lozad/dist/lozad.min.js"></script>
    <script>
        const observer = lozad();
        observer.observe();
    </script>
</head>

<body>
    @include('commons.navbar')

    @include('messages.flash')
    <div class="wrapper">
        @yield('content')

    </div>
    @include('commons.footer')
    <script src="{{asset('/js/app.js')}}"></script>
    <script src="{{asset('/js/Sidebar-Menu.js')}}"></script>    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dompurify/2.0.11/purify.min.js"></script>
    <script src="{{asset('/js/script.js')}}"></script>    
</body>

</html>    