<?php

namespace App\Console\Commands;

use App\Models\FreedomIndex;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class GetFreedomIndex extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'nls:get-freedom-index';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch World Press Freedom Index';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $result = Http::get('https://rsf.org/en/ranking');

        $re = '/<span class="ranking-map__panel-name">(.*?)<\/span><span class="ranking-map__panel-score">(.*?)<\/span>/m';

        if (preg_match_all($re, $result->body(), $m)) {
            foreach ($m[1] as $i => $country) {
                $rating = $m[2][$i];

                FreedomIndex::updateOrInsert([
                    'country' => $country,
                    'rating' => $rating
                ], ['rating' => $rating]);
            }
        }
        return 0;
    }
}
