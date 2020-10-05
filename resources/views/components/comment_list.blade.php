<div class="row">
    <div class="col col-xl-8 col-lg-10 offset-xl-2 offset-lg-1">
        @if ($article->comments()->count() > 0)                        
        @foreach ($article->newestComments(15) as $comment)
        <div class="card">
            <div class="card-body">
                <div class="media">
                    <div><span><i class="fa fa-user-circle-o"></i></span></div>
                    <div class="media-body d-flex justify-content-between">
                        <h5>{{ $comment->user->name }}</h5><small class="d-flex">{{ $comment->created_at }}</small></div>
                </div>
                <h6 class="text-muted card-subtitle mb-2">{{ $comment->title }}</h6>
                <p><?php echo nl2br(htmlspecialchars($comment->body,ENT_QUOTES,'UTF-8')); ?> </p>
                @if (Auth::id() == $comment->user_id)
                <form action="{{ route('comments.destroy',[$comment->id]) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <input type="submit" class="btn btn-danger btn-sm" value="削除">
                </form>                                    
                @endif
            </div>
        </div>                        
        @endforeach
    @endif
    </div>
</div>