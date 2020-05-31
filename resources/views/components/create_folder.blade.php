<div class="modal fade" role="dialog" tabindex="-1" id="create-folder-dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">新規フォルダの作成</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>
                <form id="folder-selection-form" action="{{ route('folders.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <input class="form-control" type="text" name="name" placeholder="フォルダ名を入力">
                        </div>    
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-light" type="button" data-dismiss="modal">閉じる</button>
                        <button class="btn btn-primary" type="submit">保存</button>
                    </div>
                </form>                   
        </div>
    </div>
</div>