<div class="modal fade" role="dialog" tabindex="-1" id="rate-stars-dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">星評価をする</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            
            <form id="star-rating-form" action="{{ route('favorites.store') }}" method="post">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="article_id" id="article-id" value=""/>

                    <div class="form-group">
                            <select class="form-control" name="stars" id="stars">
                                <optgroup label="保存先フォルダ">
                                    <option value="1" selected="">☆</option>
                                    <option value="2">☆☆</option>
                                    <option value="3">☆☆☆</option>
                                    <option value="4">☆☆☆☆</option>
                                </optgroup>
                            </select>
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