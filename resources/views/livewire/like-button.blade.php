<button class="btn btn-{{ $liked ? 'info' : 'secondary' }}" wire:click.prevent="toggleLike()">
    {{ \Illuminate\Support\Str::plural('Like', $likesCount) }} {{ $likesCount }}
</button>