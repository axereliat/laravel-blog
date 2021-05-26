@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/fm.tagator.jquery.css') }}"/>
@endpush

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <form method="post" action="{{ route('posts.update', $post) }}" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <input type="text"
                           id="title"
                           name="title"
                           value="{{ old('title') ?? $post->title }}"
                           placeholder="Title"
                           class="form-control"
                           required
                    />
                    <textarea name="content" placeholder="Enter description" id="content" cols="30"
                              rows="10">{{ old('content') ?? $post->content }}</textarea>
                    <br/>
                    <a href="{{ asset($post->thumbnail) }}" target="_blank">
                        <img style="width: 10%" class="img-thumbnail" src="{{ asset($post->thumbnail) }}"/>
                    </a>
                    <button type="button" class="btn btn-danger"
                            onclick="document.getElementById('deleteThumbnailForm').submit()">Remove</button>

                    <input type="file" class="form-control-file" name="thumbnail" />

                    <div class="my-2">
                        <label for="tags">Enter tags</label>
                        <input type="text"
                               class="form-control"
                               value="{{ $tagsString }}"
                               name="tags"
                               id="tags"
                               placeholder="tag1, tag2, tag3,..."/>
                    </div>

                    <ul class="list-group">
                        @foreach($categories as $category)
                            <li class="list-group-item">
                                <input type="checkbox"
                                       name="categories[]"
                                       value="{{$category->id}}"
                                       id="category_{{$category->id}}"
                                       @if(in_array($category->id, $selectedCategories)) checked="checked" @endif
                                />
                                <label for="category_{{$category->id}}">{{$category->name}}</label>
                            </li>
                        @endforeach
                    </ul>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
                <form id="deleteThumbnailForm" action="{{route('posts.delete-thumbnail', $post)}}" method="POST">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/fm.tagator.jquery.js') }}"></script>

    <script>
      $('#tags').tagator({
        autocomplete: @json($tags)
      });
    </script>
@endpush
