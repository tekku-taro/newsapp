<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

/**
 * @property integer $id
 * @property integer $category_id
 * @property integer $country_id
 * @property string $name
 * @property string $url
 * @property string $details
 * @property string $source
 * @property int $pagesize
 * @property int $page
 * @property string $created_at
 * @property string $updated_at
 * @property Category $category
 * @property Country $country
 * @property Article[] $articles
 */
class NewsSite extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['category_id', 'country_id', 'name', 'url', 'details', 'source', 'pagesize', 'page'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country()
    {
        return $this->belongsTo('App\Country');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function articles()
    {
        return $this->hasMany('App\Article');
    }

    public function getQueryArray(int $id)
    {
        $newsSite = $this->with(['category','country'])->where('id', $id)->select(['sources','country_id','category_id','pagesize','page'])->first();
    
        $queryArray = [
            'country'=>(isset($newsSite->country))? $newsSite->country->code:null,
            'category'=>(isset($newsSite->category))? $newsSite->category->name:null,
            'sources'=>$newsSite->sources,
            'pageSize'=>$newsSite->pagesize,
            'page'=>$newsSite->page,
        ];

        return array_filter($queryArray);
    }

    // 記事データ	該当記事があれば記事を取得	FALSE
	// なければ一括保存	保存データを返す
    public function saveAndGetArticles($apidata)
    {
        $saveData = [];
        $articleData = [];
        foreach ($apidata as $key => $record) {
            $article = $this->articles()->getArticle($record);
            if($article){
                $articleData[] = $article;
            }else{
                $saveData[] = $record;
            }
            
        }
        $articleData += $this->saveArticles($saveData);

        return $articleData;

    }

    // 記事データ	データのバリデーション	FALSE
	// 記事データを一括で保存する	保存データを返す
    public function saveArticles($articles)
    {
        $articles = $this->validateSaveData($articles);

        return $this->articles()->insert($articles);
    }

    protected function validateSaveData($data)
    {
        $rules = [
            'title'=>'required|string',
            'description'=>'required|string',
            'content'=>'required|string'
        ];

        foreach ($data as $key => $article) {
            $validator = Validator::make($article, $rules);
            if($validator->fails()){
                unset($data[$key]);
            }
        }

        return $data;
    }    
}
