<?php

namespace App\Http\Livewire;

use App\Models\Item;
use Livewire\Component;

class ItemForm extends Component
{
    public $mode = '';

    public $form = [
        'name' => '',
        'description' => '',
        'purchase_description' => '',
        'accountant' => '',
        'id' => 0
    ];

    protected $rules = [
        'form.name' => 'required|min:6',
        'form.description' => '',
        'form.purchase_description' => '',
        'form.accountant' => ''
    ];

    public function render()
    {
        $items = Item::paginate(5);

        return view('livewire.item-form', ['items' => $items]);
    }

    public function createItem() {
        $this->validate();

        $item = Item::create($this->form);

        $this->emit('saved');

        $this->dispatchBrowserEvent('closeFormModal');

        $this->reset('form');
    }

    public function updateItem() {
        $this->validate();

        $item = Item::findOrFail($this->form['id']);

        $item->update($this->form);

        $this->emit('saved');

        $this->dispatchBrowserEvent('closeFormModal');

        $this->reset('form');
    }

    public function newItem() {
        $this->mode = 'create';
    }

    public function removeItem(Item $item) {
        $this->form['id'] = $item->id;
    }

    public function deleteItem() {
        Item::findOrFail($this->form['id'])->delete();

        $this->emit('deleted');

        $this->dispatchBrowserEvent('closeConfirmModal');

        $this->reset('form');
    }

    public function editItem(Item $item) {
        $this->mode = 'edit';

        $this->form['name'] = $item->name;
        $this->form['description'] = $item->description;
        $this->form['purchase_description'] = $item->purchase_description;
        $this->form['accountant'] = $item->accountant;
        $this->form['id'] = $item->id;
    }
}
