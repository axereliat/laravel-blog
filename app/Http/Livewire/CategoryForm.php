<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Livewire\Component;

class CategoryForm extends Component
{

    public $name;

    protected $rules = [
        'name' => 'required|min:6'
    ];

    public function render()
    {
        return view('livewire.category-form');
    }

    public function save() {
        $this->validate();

        $category = new Category();

        $category->name = $this->name;

        $category->save();

        $this->emit('categoryAdded');
        $this->emit('saved');

        // session()->flash('success_message', 'Category successfully created.');
    }
}
