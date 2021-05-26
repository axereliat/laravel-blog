@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/fm.tagator.jquery.css') }}"/>
@endpush

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <form method="post" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                    @csrf
                    <input id="title" placeholder="title" type="text" class="form-control" name="title" required
                           autocomplete="name" autofocus/>
                    <textarea name="content" placeholder="Enter description" id="" cols="30" rows="10"></textarea>

                    <input type="file" class="form-control-file" name="thumbnail" />

                    <div class="my-2">
                        <label for="tags">Enter tags</label>
                        <input type="text"
                               name="tags"
                               id="tags"
                               placeholder="tag1, tag2, tag3,..."/>
                    </div>

                    <ul class="list-group">
                        @foreach($categories as $category)
                            <li class="list-group-item">
                                <input type="checkbox" name="categories[]" value="{{$category->id}}" id="category_{{$category->id}}"/>
                                <label for="category_{{$category->id}}">{{$category->name}}</label>
                            </li>
                        @endforeach
                    </ul>

                    <button type="submit" class="btn btn-primary">Create</button>
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