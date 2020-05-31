<aside id="sidebar" class="sidebar pt-3">
    <h5 class="sidebar-header">ユーザ管理</h5>
    <ul class="sidemenu sidemenu-list">
        <li class="{{ (Request::routeIs('users.index'))? 'active':'' }}">
            <a href="{{ route('users.index') }}" >一覧</a>
        </li>
        <li class="{{ (Request::routeIs('users.create'))? 'active':'' }}">
            <a href="{{ route('users.create') }}" >新規登録</a>
        </li>        
    </ul>
</aside>