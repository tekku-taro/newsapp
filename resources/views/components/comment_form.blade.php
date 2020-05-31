<div class="row">
    <div class="col col-xl-8 col-lg-10 offset-xl-2 offset-lg-1">
        <form method="post" action="{{ route('comments.store') }}">
            @csrf
            <input type="hidden" name="article_id" value="{{ $article->id }}">
            <h4 class="text-center">コメントフォーム</h4>
            <div class="form-group row"><label class="col-form-label col-md-3" for="title">タイトル</label>
                <div class="col col-md-9">
                    <input class="form-control" type="text" id="title" name="title" value="{{ old('title') }}">
                    @error('title')
                    <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="form-group row"><label class="col-form-label col-md-3" for="comment-body">本文</label>
                <div class="col col-md-9">
                    <textarea class="form-control" id="comment-body" name="body" rows="6">{{ old('body') }}</textarea>
                    @error('body')
                    <small class="form-text text-danger">{{ $message }}</small>
                    @enderror                            
                </div>
            </div>
            <div class="form-group text-center"><button class="btn btn-primary save-btn" type="submit">投稿</button></div>
        </form>
    </div>
</div>