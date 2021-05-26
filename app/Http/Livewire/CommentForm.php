<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class CommentForm extends Component
{
    public $content;

    /** @var Post $post */
    public $post;

    public function mount(Post $post) {
        $this->post = $post;
    }

    public function render()
    {
        return view('livewire.comment-form');
    }

    public function postComment() {
        $this->post->comments()->create(['content' => $this->content, 'user_id' => auth()->id()]);

        $this->emit('saved');
        $this->emit('commentPosted');

        $this->reset('content');
    }
}
