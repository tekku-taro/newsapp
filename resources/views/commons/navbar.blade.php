<nav class="navbar navbar-dark navbar-expand-md sticky-top bg-secondary">
    <div class="container-fluid"><a class="navbar-brand" href="{{ route('top') }}">Newsapp</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse"
            id="navcol-1">
            @if (Auth::check())
            <ul class="nav navbar-nav">
                <li class="nav-item" role="presentation"><a class="nav-link {{ (Request::routeIs('news.index'))? 'active':'' }}" href="{{ route('news.index') }}">ニュース</a></li>
                <li class="nav-item" role="presentation"><a class="nav-link {{ (Request::routeIs('clippings.index'))? 'active':'' }}" href="{{ route('clippings.index') }}">クリップ記事</a></li>
                <li class="nav-item" role="presentation"><a class="nav-link {{ (Request::routeIs('news_sites.index'))? 'active':'' }}" href="{{ route('news_sites.index') }}">配信サイト</a></li>
                <li class="nav-item" role="presentation"><a class="nav-link {{ (Request::routeIs('users.index'))? 'active':'' }}" href="{{ route('users.index') }}">ユーザ設定</a></li>
            </ul>
            <ul class="nav navbar-nav ml-auto">
                <li class="nav-item" role="presentation">
                    <div class="nav-item dropdown"><a class="dropdown-toggle active" data-toggle="dropdown" aria-expanded="false" href="#"><i class="fa fa-user-circle-o"></i>User</a>
                        <div class="dropdown-menu text-left dropdown-menu-right" role="menu">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <input type="submit" value="Log out" class="dropdown-item">
                            </form>
                        </div>
                    </div>
                </li>
            </ul>
                
            @else
            <ul class="nav navbar-nav ml-auto">
                <li class="nav-item" role="presentation"><a class="nav-link" href="{{ route('register') }}">Signup</a></li>
                <li class="nav-item" role="presentation"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
            </ul>                
            @endif



        </div>
    </div>
</nav>