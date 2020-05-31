<aside id="sidebar" class="sidebar pt-3">
    <h5 class="sidebar-header">サイト一覧</h5>
    <ul class="sidemenu sidemenu-list">
        @foreach ($siteList as $site)
            @if ($site->name == '全て')
                <li class="{{ ($site->id == $newsSite->id)? 'active':'' }}">
                    <a href="{{ route('news.index') }}" >{{ $site->name }}</a>
                </li>                                    
            @else
            <li class="{{ ($site->id == $newsSite->id)? 'active':'' }}">
                <a href="{{ route('news.index',['sources'=>$site->id]) }}" >{{ $site->name }}</a>
            </li>                
            @endif
        @endforeach
    </ul>
</aside>