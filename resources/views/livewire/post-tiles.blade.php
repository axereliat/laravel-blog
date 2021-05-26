<div>
    <div class="row">
        @foreach($posts as $post)
            <div class="col-md-4">
                <div class="card">
                    <img src="{{ asset($post->thumbnail) }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <p class="card-text">{{ $post->content }}</p>
                        <a href="{{ route('posts.edit', $post) }}" class="btn btn-primary">Edit</a>
                        <a href="javascript: void(0)"
                           onclick="
                                   if (confirm('Are you sure?')) {
                                   document.getElementById('deletePostForm_{{ $post->id }}').submit();
                                   }
                                   "
                           class="btn btn-danger">Delete</a>
                        <a href="{{ route('comments.index', $post->id) }}" class="btn btn-primary">Details</a>
                        <form id="deletePostForm_{{ $post->id }}"
                              action="{{ route('posts.destroy', $post) }}"
                              method="post"
                              style="display: none">
                            @csrf
                            @method('DELETE')
                        </form>

                        <div>
                            Author: <strong>{{$post->author->name}}</strong>
                            | created at: <strong>{{$post->created_at->diffForHumans()}}</strong>
                        </div>
                        <div>{{ $post->tags->pluck('name')->join(' ') }}</div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    {{ $posts->links() }}
</div>