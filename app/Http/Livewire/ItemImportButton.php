<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ItemImportButton extends Component
{
    public function render()
    {
        return view('livewire.item-import-button');
    }

    public function importData() {
        $uploadedFile = '/Users/mario/Documents/laravel_apps/advanced-blog/public/iif/Item-list.IIF';
        if (file_exists($uploadedFile) && is_readable($uploadedFile)) {
            $lines = array_map('trim', file($uploadedFile));
            foreach ($lines as $line) {
                $cols = explode("\t", $line);
                dd($cols);
            }
        }
    }
}
