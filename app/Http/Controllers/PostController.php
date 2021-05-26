<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PostController extends Controller
{
    public function index(): View
    {
        $posts = Post::paginate(20);

        return view('posts.index', ['posts' => $posts]);
    }

    public function create(): View
    {
        $categories = Category::orderBy('name')->get();
        $tags = Tag::all()->pluck('name')->toArray();

        return view('posts.create', ['categories' => $categories, 'tags' => $tags]);
    }

    public function store(Request $request): RedirectResponse
    {
        $post = Post::create();

        $post->title = $request->input('title');
        $post->content = $request->input('content');

        if ($request->hasFile('thumbnail')) {
            //dd($request->all());
            $path = $request->file('thumbnail')->store('thumbnails');

            $post->thumbnail = $path;
        } else {
            $post->thumbnail = 'https://via.placeholder.com/150';
        }

        $post->created_by = \Auth::user();

        $tagNames = explode(',', $request->input('tags'));

        foreach ($tagNames as $tagName) {
            $post->tags()->firstOrCreate(['name' => $tagName]);
        }

        $post->save();

        $post->categories()->sync($request->categories);

        return redirect()
            ->route('posts.index')
            ->with('success_message', 'Created successfully.');
    }

    public function edit(Post $post): View
    {
        $categories = Category::orderBy('name')->get();

        $tagsString = $post->tags()->pluck('name')->join(', ');

        $selectedCategories = $post->categories()->pluck('id')->toArray();

        $tags = Tag::all()->pluck('name')->toArray();

        return view('posts.edit', ['post' => $post, 'tagsString' => $tagsString, 'categories' => $categories,
            'selectedCategories' => $selectedCategories, 'tags' => $tags]);
    }

    public function update(Request $request, Post $post): RedirectResponse
    {
        $post->title = $request->input('title');
        $post->content = $request->input('content');

        if ($request->hasFile('thumbnail')) {
            //dd($request->all());
            if ($post->thumbnail !== null && file_exists($post->thumbnail)) {
                unlink($post->thumbnail);
            }
            $path = $request->file('thumbnail')->store('thumbnails');

            $post->thumbnail = $path;
        }

        $tagNames = explode(', ', $request->input('tags'));

        foreach ($tagNames as $tagName) {
            $post->tags()->firstOrCreate(['name' => $tagName]);
        }

        $post->save();

        $post->categories()->sync($request->categories);

        return redirect()
            ->route('posts.index')
            ->with('success_message', 'Updated successfully.');
    }

    public function deleteThumbnail(Post $post) {
        if ($post->thumbnail !== null && file_exists($post->thumbnail)) {
            unlink($post->thumbnail);
            $post->thumbnail = 'https://via.placeholder.com/150';
            $post->save();
        }

        return redirect(route('posts.edit', $post))
            ->with('success_message', 'Thumbnail successfully removed.');
    }

    public function destroy(Post $post): RedirectResponse
    {
        $post->delete();

        return redirect()
            ->route('posts.index')
            ->with('success_message', 'Deleted successfully.');
    }
}
