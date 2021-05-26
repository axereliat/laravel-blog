<div>
    <x-jet-action-message on="saved">
        Your comment was deleted.
    </x-jet-action-message>
    <ul class="list-group" id="commentsList">
        @foreach($comments as $comment)
            <li class="list-group-item" style="background-color: white">
                <strong>{{$comment->author->name}} / {{$comment->created_at->format('m/d/Y H:i:s')}}</strong>
                <div class="d-flex justify-content-between">
                    {{$comment->content}}
                    @can('delete-comment', $comment)
                        <button class="btn btn-danger float-right"
                                data-toggle="modal" data-target="#confirmModal"
                        wire:click.prevent="confirmDeletion({{ $comment->id }})">
                            Delete
                        </button>
                    @endcan
                </div>
            </li>
        @endforeach
    </ul>

    <!-- Modal -->
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true"
    wire:ignore>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalLabel">Delete confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" wire:click.prevent="deleteComment()">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        window.addEventListener('closeModal', function () {
          var myModalEl = document.getElementById('confirmModal')
          var modal = coreui.Modal.getInstance(myModalEl)
          modal.hide();
        });
    </script>
@endpush