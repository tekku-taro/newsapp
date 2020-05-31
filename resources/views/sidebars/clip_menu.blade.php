<aside id="sidebar" class="sidebar pt-3">
    <h5 class="sidebar-header">フォルダ一覧</h5>
    <ul class="sidemenu sidemenu-list">
        @foreach ($folderList as $id => $folderName)
            <li class="{{ (isset($folder) && $id == $folder->id)? 'active':'' }}">
                <a href="{{ route('clippings.index',['folder_id'=> $id]) }}" >{{ $folderName }}</a>
            </li>                
        @endforeach
    </ul>
    <h5 class="sidebar-header">フォルダ管理</h5>
    <ul class="sidemenu manage-folder">
        <li><button class="btn btn-outline-info btn-sm border-info" type="button" data-toggle="modal" data-target="#create-folder-dialog"><i class="fa fa-plus"></i></button></li>
        <li><button class="btn btn-outline-danger btn-sm border-danger" type="button" data-toggle="modal" data-target="#delete-folder-dialog"><i class="fa fa-minus"></i></button>&nbsp;</li>
    </ul>
</aside>