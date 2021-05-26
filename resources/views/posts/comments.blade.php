@extends('layouts.app')

@section('content')
    <h1 class="text-center">{{ $post->title }}</h1>
    <div>{{ $post->content }}</div>

    <livewire:like-button :post="$post->id"/>
    <livewire:comment-form :post="$post->id"/>
    <livewire:comment-list :post="$post->id"/>
@endsection

@push('scripts')
    <script>
      $(document).on('ready', function () {
        $('button[id^="deleteCommentBtn"]').on('click', function (e) {
          e.preventDefault()

          var commentId = $(this).attr('id').split('-')[1]

          var $self = $(this)

          $.ajax({
            url: '/posts/{{ $post->id }}/comments/' + commentId,
            method: 'DELETE',
            success: function (res) {
              $self.closest('li').remove()
            }
          })
        })

        $('#postCommentForm').on('submit', function (e) {
          e.preventDefault()

          var comment = $('#content').val()

          $('#postBtn').attr('disabled', true)
          $('#postBtn').html('Please wait...')

          $.ajax({
            url: '{{ route('comments.store', $post->id) }}',
            method: 'POST',
            data: {
              content: comment
            },
            success: function (res) {
              $('#postBtn').attr('disabled', false)
              $('#postBtn').html('Post')

              $('#content').val('')

              $('#commentsList').prepend(
                $('<li class="list-group-item" style="background-color: white">' + comment + '</li>').append(
                  $('<button class="btn btn-danger float-right">Delete</button>')
                )
              )
            }
          })
        })
      })
    </script>
@endpush