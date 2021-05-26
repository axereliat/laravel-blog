<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use App\Models\Post;
use Livewire\Component;

class CommentList extends Component
{
    /** @var Post $post */
    public $post;

    public $selectedCommentId;

    protected $listeners = ['commentPosted' => 'render'];

    public function mount(Post $post) {
        $this->post = $post;
    }

    public function render()
    {
        return view('livewire.comment-list', ['comments' => $this->post->comments()->get()]);
    }

    public function confirmDeletion(int $commentId) {
        $this->selectedCommentId = $commentId;
    }

    public function deleteComment() {
        $this->post->comments()->findOrFail($this->selectedCommentId)->delete();

        $this->emit('saved');

        $this->dispatchBrowserEvent('closeModal');
    }
}
