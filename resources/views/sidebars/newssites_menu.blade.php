<aside id="sidebar" class="sidebar pt-3">
    <h5 class="sidebar-header">サイト管理</h5>
    <ul class="sidemenu sidemenu-list">
        <li class="{{ (Request::routeIs('news_sites.index'))? 'active':'' }}">
            <a href="{{ route('news_sites.index') }}" >一覧</a>
        </li>
        <li class="{{ (Request::routeIs('news_sites.create'))? 'active':'' }}">
            <a href="{{ route('news_sites.create') }}" >新規登録</a>
        </li>   
    </ul>
</aside>