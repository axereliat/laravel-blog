<div>
    <x-jet-action-message class="mr-3" on="saved">
        {{ __('Deleted.') }}
    </x-jet-action-message>
    <div class="card">
        <div class="card-body">
            <ul class="list-group">
                @foreach($categories as $category)
                    <li class="list-group-item d-flex justify-content-between">
                        <div>{{$category->name}}</div>
                        <button class="btn btn-danger btn-sm" wire:click.prevent="deleteCategory({{$category->id}})">Delete</button>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>