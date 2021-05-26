<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class PostTiles extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['filter'];

    public $selectedCategories = [];
    public $selectedTags = [];

    public function filter($data)
    {
        $this->selectedCategories = $data['selectedCategories'];
        $this->selectedTags = $data['selectedTags'];
    }

    public function render()
    {
        $posts = Post::when(count($this->selectedCategories) > 0, function (Builder $builder) {
                $builder->whereHas('categories', function (Builder $q) {
                    $q->whereIn('id', $this->selectedCategories);
                });
            })
            ->when(count($this->selectedTags) > 0, function (Builder $builder) {
                $builder->whereHas('tags', function (Builder $q) {
                    $q->whereIn('name', $this->selectedTags);
                });
            })
            ->orderByDesc('id')
            ->paginate();

        return view('livewire.post-tiles', ['posts' => $posts]);
    }
}
