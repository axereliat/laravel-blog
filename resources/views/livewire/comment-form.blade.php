<div class="container">
    <x-jet-action-message on="saved">
        Your comment was posted.
    </x-jet-action-message>
    @auth
        <form wire:submit.prevent="postComment()">
            <textarea cols="30" rows="10" wire:model.defer="content"></textarea>
            <button type="submit" class="btn btn-primary" id="postBtn">Post</button>
        </form>
    @endauth
</div>