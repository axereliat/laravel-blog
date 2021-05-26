<div class="container">
    <x-jet-action-message class="mr-3" on="saved">
        {{ __('Saved.') }}
    </x-jet-action-message>
    <x-jet-action-message class="mr-3" on="deleted">
        {{ __('Deleted.') }}
    </x-jet-action-message>
    <div class="card">
        <div class="card-body">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#itemCreateModal"
            wire:click.prevent="newItem()">
                Create Item
            </button>
        </div>
    </div>

    <div class="modal fade" id="itemCreateModal" tabindex="-1" role="dialog" aria-labelledby="itemCreateModalLabel"
         aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="itemCreateModalLabel">
                        {{ $mode === 'create' ? 'Create Item' : 'Edit Item'}}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" wire:model="form.name" name="name" class="form-control" id="name"/>
                            @error('form.name') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" class="form-control" cols="30"
                                      rows="10" wire:model="form.description"></textarea>
                            @error('form.description') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="purchase_description" class="form-label">Purchase description</label>
                            <textarea name="purchase_description" id="purchase_description" class="form-control"
                                      cols="30"
                                      wire:model="form.purchase_description"
                                      rows="10"></textarea>
                            @error('form.purchase-description') <span
                                    class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="accountant" class="form-label">Accountant</label>
                            <input type="text" name="accountant" class="form-control"
                                   id="accountant" wire:model="form.accountant"/>
                            @error('form.accountant') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                        @if ($mode === 'create')
                            <button type="button" class="btn btn-primary" wire:click.prevent="createItem()">Create</button>
                        @else
                            <button type="button" class="btn btn-primary" wire:click.prevent="updateItem()">Edit</button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteConfirmationModal"
         tabindex="-1" role="dialog" aria-labelledby="deleteConfirmationLabel"
         aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteConfirmationLabel">
                        Delete Item
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form>
                    <div class="modal-body">
                        <p>Are you sure you want to delete this item?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger" wire:click.prevent="deleteItem()">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <table class="table">
        <tbody>
        @foreach($items as $item)
            <tr>
                <td>
                    {{ $item->name }}
                </td>
                <td>
                    {{ $item->description }}
                </td>
                <td>
                    <button class="btn btn-primary" wire:click.prevent="editItem({{ $item->id }})"
                            data-toggle="modal" data-target="#itemCreateModal">Edit</button>
                    <button class="btn btn-danger"
                            data-toggle="modal"
                            data-target="#deleteConfirmationModal"
                            wire:click.prevent="removeItem({{ $item->id }})">Delete</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $items->links() }}

</div>

@push('scripts')
    <script>
      window.addEventListener('closeFormModal', function (e) {
        var formModal = coreui.Modal.getInstance(document.getElementById('itemCreateModal'))
        formModal.hide()
      })
      window.addEventListener('closeConfirmModal', function (e) {
        var deleteConfModal = coreui.Modal.getInstance(document.getElementById('deleteConfirmationModal'))
        deleteConfModal.hide()
      })
    </script>
@endpush