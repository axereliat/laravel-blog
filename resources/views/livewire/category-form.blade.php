<div class="container">
    <x-jet-action-message class="mr-3" on="saved">
        {{ __('Saved.') }}
    </x-jet-action-message>
    <div class="card">
        <div class="card-body">
            <form method="post" class="form-inline" wire:submit.prevent="save()">
                <label for="name" class="mb-2 mr-sm-2">Name</label>
                <div>
                    <input type="text"
                           wire:model="name"
                           id="title"
                           placeholder="name"
                           class="form-control mb-2 mr-sm-2"
                           name="title"
                    />
                    @error('name')
                    <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary mb-2 mr-sm-2">Create</button>
            </form>
        </div>
    </div>
</div>