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
    <link rel="stylesheet" href="{{ asset('/css/news.css')}}">
    <link rel="stylesheet" href="{{ asset('/css/styles.css')}}">
</head>

<body>
    @include('commons.navbar')

    @include('messages.flash')

    @yield('contents')

    <footer>
        <div class="container footer-container">
            <ul class="list-inline">
                <li class="list-inline-item"><a href="#">ニュース</a></li>
                <li class="list-inline-item"><a href="#">クリップ記事</a></li>
                <li class="list-inline-item"><a href="#">配信サイト</a></li>
                <li class="list-inline-item"><a href="#">ユーザ設定</a></li>
            </ul>
            <p class="copyright">newsapp developer © 2020</p>
        </div>
    </footer>
    <script src="{{asset('/js/jquery.min.js')}}"></script>
    <script src="{{asset('/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('/js/Sidebar-Menu.js')}}"></script>    
</body>

</html>    