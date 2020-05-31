<?php

use Illuminate\Database\Seeder;
use App\NewsSite;

class NewsSitesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'name'=>'BBC NEWS',
            'sources'=>'bbc-news',
            'url'=>'https://www.bbc.com'
        ];
        NewsSite::create($data);
        factory(App\NewsSite::class, 5)->create();
    }
}
