<?php

use Illuminate\Database\Seeder;
use App\NewsSite;

class NewsSitesTableSeeder extends Seeder
{
    public $sources = [
        ["name"=>"BBC NEWS","url"=>"https://www.bbc.com", "details"=>null,"sources"=>"bbc-news","category_id"=>null, "country_id"=>null, "pagesize"=>5],
        ["name"=>"全て", "url"=>null,"details"=>"ニュース全て","sources"=>null,"category_id"=>3,"country_id"=>108, "pagesize"=>20],
        ["name"=>"Reuters", "url"=>"https://www.reuters.com", "details"=>null,"sources"=>"reuters","category_id"=>null,"country_id"=>null, "pagesize"=>5],
        ["name"=>"CNN", "url"=>"https://www.cnn.com", "details"=>null,"sources"=>"cnn","category_id"=>null,"country_id"=>null, "pagesize"=>5],
        ["name"=>"Engadget", "url"=>"https://www.engadget.com", "details"=>null,"sources"=>"engadget","category_id"=>null,"country_id"=>null,	"pagesize"=>5],
        ["name"=>"Independent", "url"=>"https://www.independent.co.uk", "details"=>null,"sources"=>"independent","category_id"=>null,"country_id"=>null, "pagesize"=>5],
        ["name"=>"米国の報道", "url"=>"https://www.msn.com", "details"=>null,"sources"=>null,"category_id"=>3,"country_id"=>220, "pagesize"=>20],
        ["name"=>"イギリスの報道", "url"=>"https://www.bbc.com/news/uk", "details"=>null,"sources"=>null,"category_id"=>3,"country_id"=>74, "pagesize"=>20],
    ];



    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $data = [
        //     'name'=>'BBC NEWS',
        //     'sources'=>'bbc-news',
        //     'url'=>'https://www.bbc.com'
        // ];
        // NewsSite::create($data);
        // factory(App\NewsSite::class, 5)->create();
        NewsSite::insert($this->sources);
    }
}
