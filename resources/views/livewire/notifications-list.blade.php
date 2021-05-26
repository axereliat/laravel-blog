<ul class="list-group">
    @foreach($notifications as $notification)
        <li class="list-group-item">
            <a wire:click.prevent="markSeen({{ $notification->id }})" href="#">{{ $notification->description }}</a>
        </li>
    @endforeach
</ul>