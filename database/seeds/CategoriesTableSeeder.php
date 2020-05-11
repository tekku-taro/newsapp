<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = [
            'ビジネス'=>'business',
            '娯楽'=>'entertainment',
            '一般'=>'general',
            '健康'=>'health',
            '科学'=>'science',
            'スポーツ'=>'sports',
            '技術'=>'technology',
        ];
        foreach ($category as $key => $value) {
            Category::create(['name_jp'=>$key,'name'=>$value]);
        }
    }
}
