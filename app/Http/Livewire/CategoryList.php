<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Livewire\Component;
use PhpParser\Node\Expr\Array_;

class CategoryList extends Component
{
    protected $listeners = [
        'categoryAdded' => 'render'
    ];

    public function render()
    {
        return view('livewire.category-list',
            [
                'categories' => Category::orderByDesc('id')->get()
            ]
        );
    }

    public function deleteCategory(Category $category) {
        $category->delete();

        $this->emit('saved');
    }
}
