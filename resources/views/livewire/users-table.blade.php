<div class="container">
    <x-jet-action-message class="mr-3" on="saved">
        {{ __('Saved.') }}
    </x-jet-action-message>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Access Level</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>
                    <select wire:change="changeRole({{ $user }}, $event.target.value)" class="form-control" id="exampleFormControlSelect1" @if (auth()->user()->id === $user->id) disabled @endif>
                        <option value="1" @if ($user->access_level === 1) selected @endif>ADMIN</option>
                        <option value="2" @if ($user->access_level === 2) selected @endif>USER</option>
                    </select>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>