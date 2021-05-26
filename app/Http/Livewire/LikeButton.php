<?php

namespace App\Http\Livewire;

use App\Models\Like;
use App\Models\Notification;
use App\Models\Post;
use Livewire\Component;

class LikeButton extends Component
{
    public $post;

    public $liked;

    public $likesCount;

    public function mount(Post $post)
    {
        $this->post = $post;

        $this->likesCount = Like::all()->where('post_id', $post->id)->count();
        $this->liked = Like::all()->where('post_id', $post->id)
            ->where('user_id', auth()->id())->count() > 0;
    }

    public function render()
    {
        return view('livewire.like-button');
    }

    public function toggleLike()
    {
        $this->liked = !$this->liked;

        if ($this->liked) {
            Like::create(
                [
                    'user_id' => auth()->id(),
                    'post_id' => $this->post->id
                ]
            );

            $this->likesCount++;
        } else {
            $notification = Notification::where('user_id', auth()->id())
                ->where('post_id', $this->post->id)->first();

            if ($notification !== null) {
                $notification->delete();
            }

            Like::query()->where('post_id', $this->post->id)
                ->where('user_id', auth()->id())->delete();

            $this->likesCount--;
        }
    }
}
