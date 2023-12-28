<div class=" comment">
    @auth
    <h4>Comments</h4>
    {{-- {{$article->comments}} --}}
    {{-- $article->comments => colletion
        $article->comments() => query
    --}}
        @forelse ($article->comments()->whereNull("parent_id")->latest("id")->get() as $comment )
            <div class="card mb-3">
                <div class="card-body">
                    <p class="mb-0">
                        <i class="bi bi-chat-square-text-fill me-2"></i>
                        {{$comment->content}}
                    </p>
                    <div class="">
                        <span class="badge bg-dark ">
                            <i class="bi bi-person"></i>
                            {{$comment->user->name}}
                        </span>
                        <span class="badge bg-dark ">
                            <i class="bi bi-clock"></i>
                            {{$comment->created_at->diffForHumans()}}
                        </span>

                        @can('delete', $comment)
                            <form action="{{route('comment.destroy',$comment->id)}}" method="post" class="d-inline-block">
                                @csrf
                                @method('delete')
                                <button class="badge border-0 bg-dark ">
                                    <i class="bi bi-trash3"></i>
                                    Delete
                                </button>
                            </form>
                        @endcan

                        <span role="button" class="badge bg-dark reply-btn user-select-none">
                            <i class="bi bi-reply"></i>
                            Reply
                        </span>

                        <form action="{{route('comment.store')}}" class="mt-3 ms-5 d-none" method="post">
                            @csrf
                            <input type="hidden" name="parent_id" value="{{$comment->id}}">
                            {{-- <input type="hidden" name="user_id" value="{{ Auth::id() }}"> --}}
                            <input type="hidden" name="article_id" value="{{ $article->id }}">
                            <textarea name="content" class="form-control mb-2" rows="2" placeholder="reply to this comment ..."></textarea>
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="mb-0 ">Replying as {{ Auth::user()->name }}</p>
                                <button class="btn btn-dark btn-sm mt-2">Reply</button>
                            </div>
                        </form>


                       @foreach ($comment->replies()->latest("id")->get() as $reply)
                            <div class="card my-3 ms-5">
                                <div class="card-body">
                                    <p class="mb-0">
                                        <i class="bi bi-reply-fill me-2"></i>
                                        {{$reply->content}}
                                    </p>
                                    <div class="">
                                        <span class="badge bg-dark ">
                                            <i class="bi bi-person"></i>
                                            {{$reply->user->name}}
                                        </span>
                                        <span class="badge bg-dark ">
                                            <i class="bi bi-clock"></i>
                                            {{$reply->created_at->diffForHumans()}}
                                        </span>

                                        @can('delete', $reply)
                                            <form action="{{route('comment.destroy',$reply->id)}}" method="post" class="d-inline-block">
                                                @csrf
                                                @method('delete')
                                                <button class="badge border-0 bg-dark ">
                                                    <i class="bi bi-trash3"></i>
                                                    Delete
                                                </button>
                                            </form>
                                        @endcan


                                    </div>
                                </div>
                            </div>
                       @endforeach

                    </div>
                </div>
            </div>
        @empty
            <div class="card mb-3">
                <div class="card-body text-center">
                    <p class="mb-0">There is no comment.</p>
                </div>
            </div>
        @endforelse

        <form action="{{route('comment.store')}}" method="post">
            @csrf
            {{-- <input type="hidden" name="user_id" value="{{ Auth::id() }}"> --}}
            <input type="hidden" name="article_id" value="{{ $article->id }}">
            <textarea name="content" class="form-control mb-2" rows="3" placeholder="say something about this article ..."></textarea>
            <div class="d-flex justify-content-between align-items-center">
                <p class="mb-0 ">Commenting as {{ Auth::user()->name }}</p>
                <button class="btn btn-dark btn-sm mt-2">Comment</button>
            </div>
        </form>
    @endauth
    @guest
        <div class=" card">
            <div class="card-body text-center">
                <p><a href="{{route('login')}}">Login here</a> to comment in this article</p>
            </div>
        </div>
    @endguest
</div>

@vite(["resources/js/reply.js"])
