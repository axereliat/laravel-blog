<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Tag;
use Livewire\Component;

class FilterPosts extends Component
{
    public $selectedCategories = [];
    public $selectedTags = [];

    public function render()
    {
        return view('livewire.filter-posts',
            [
                'categories' => Category::orderBy('name')->get(),
                'tags' => Tag::all()
            ]
        );
    }

    public function filter() {

        $this->emit('filter', [
            'selectedCategories' => $this->selectedCategories,
            'selectedTags' => $this->selectedTags
        ]);
    }
}
