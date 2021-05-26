<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    public function readCSV(string $csvFile, string $delimiter = ';'): array
    {
        $lineOfText = [];
        $fileHandle = fopen($csvFile, 'r');
        while (!feof($fileHandle)) {
            $lineOfText[] = fgetcsv($fileHandle, 0, $delimiter);
        }
        fclose($fileHandle);

        return $lineOfText;
    }

    public function run(): void
    {
        $csvFileName = "items.csv";
        $csvFile = public_path('csv/' . $csvFileName);
        $lines = $this->readCSV($csvFile);

        foreach ($lines as $line) {
            Item::create([
                'name' => $line[0],
                'description' => $line[1],
                'purchase_description' => $line[2],
                'accountant' => $line[3],
            ]);
        }
    }
}
