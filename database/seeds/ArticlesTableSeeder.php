<?php

use Illuminate\Database\Seeder;
use App\Article;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'title'=>'Coronavirus updates: Italy relaxes lockdown as number of deaths falls - BBC News',
            'description'=>'The number of deaths in Italy is at its lowest level since just after its lockdown began in March.',
            'url'=>'https://www.bbc.co.uk/news/live/world-52525531',
            'url_to_image'=>'https://m.files.bbci.co.uk/modules/bbc-morph-news-waf-page-meta/4.1.2/bbc_news_logo.png',
            'published_at'=>'2020-05-04',
            'content'=>'Khan performed a song for his fansImage caption: Khan performed a song for his fans\r\nMore than 70 of India\'s biggest stars performed from their homes in a four hour concert to help raise funds for the fight against Covid-19 in India, where cases have steadily… [+1105 chars]',
            'news_site_id'=>'1',
            'volume'=>'3',
            'author'=>'https://www.facebook.com/bbcnews',
        ];
        Article::create($data);
    }
}
