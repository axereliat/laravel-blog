<?php

namespace App\Observers;

use App\Models\Like;
use App\Models\Notification;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class LikesObserver
{
    /**
     * Handle the Likes "created" event.
     *
     * @param  \App\Models\Like  $like
     * @return void
     */
    public function created(Like $like)
    {
        $postAuthor = Post::findOrFail($like->post_id)->created_by;

        if ($like->user_id === $postAuthor) {
            return;
        }

        $link = route('comments.index', $like->post_id);
        $description = User::findOrFail($like->user_id)->name . ' liked your post';

        $data = [
            'user_id' => $like->user_id,
            'owner_id' => $postAuthor,
            'post_id' => $like->post_id,
            'description' => $description,
            'link' => parse_url($link, PHP_URL_PATH)
        ];

        Notification::create($data);
    }

    /**
     * Handle the Likes "updated" event.
     *
     * @param  \App\Models\Like  $likes
     * @return void
     */
    public function updated(Like $likes)
    {
        //
    }

    /**
     * Handle the Likes "deleted" event.
     *
     * @param  \App\Models\Like  $like
     * @return void
     */
    public function deleted(Like $like)
    {
        //
    }

    /**
     * Handle the Likes "restored" event.
     *
     * @param  \App\Models\Like  $likes
     * @return void
     */
    public function restored(Like $likes)
    {
        //
    }

    /**
     * Handle the Likes "force deleted" event.
     *
     * @param  \App\Models\Like  $likes
     * @return void
     */
    public function forceDeleted(Like $likes)
    {
        //
    }
}
