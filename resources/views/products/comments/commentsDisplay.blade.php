@foreach($comments as $comment)
    <div class="card-body comment-body"
         @if($comment->parent_id != null)
            style="padding-right: 0px;"
        @endif
    >
        <div>{{ $comment->comment }}</div>
        <small class="text-muted">Posted by {{$comment->user->getFullName()}}</small>
        <a href="" id="reply"></a>
        <form method="post" action="{{ route('products.comments.addComment', $product) }}">
            @csrf
            <div class="form-group mr-0 mb-1">
                <input type="text" name="comment" class="form-control comment-input" />
                <input type="hidden" name="product_id" value="{{ $product->id }}" />
                <input type="hidden" name="parent_id" value="{{ $comment->id }}" />
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-sm btn-warning btn-comment" value="Reply" />
            </div>
        </form>
        @include('products.comments.commentsDisplay', ['comments' => $comment->replies])
    </div>
@endforeach
