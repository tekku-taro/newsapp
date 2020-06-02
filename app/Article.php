<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property integer $id
 * @property integer $news_site_id
 * @property string $title
 * @property string $description
 * @property string $url
 * @property string $url_to_image
 * @property string $published_at
 * @property string $content
 * @property int $volume
 * @property string $author
 * @property string $created_at
 * @property string $updated_at
 * @property NewsSite $newsSite
 * @property Comment[] $comments
 * @property User[] $favorites
 * @property Folder[] $folders
 * @property User[] $histories
 */
class Article extends Model
{

    // １分間に読む文字数
    public static $countsPerMin = 500;

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['news_site_id', 'title', 'description', 'url', 'url_to_image', 'published_at', 'content', 'volume', 'author'];


    protected $dates = ['published_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function newsSite()
    {
        return $this->belongsTo('App\NewsSite');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function favorites()
    {
        return $this->belongsToMany('App\User', 'favorites', 'article_id', 'user_id')->withPivot('stars')->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function folders()
    {
        return $this->belongsToMany('App\Folder', 'folder_article', 'article_id', 'folder_id')->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function histories()
    {
        return $this->belongsToMany('App\User', 'histories', 'article_id', 'user_id')->withTimestamps();
    }

    public function setUrlToImageAttribute($value)
    {
        if (strlen($value) > 191) {
            $value = null;
        }
        $this->attributes['url_to_image'] = $value;
    }

    public function getUrlToImageAttribute($value)
    {
        if (empty($value)) {
            $value = asset('img/Placeholder.png') ;
        }
        return $value;
    }

    public function setAuthorAttribute($value)
    {
        if (strlen($value) > 191) {
            $value = substr($value, 0, 191);
        }
        $this->attributes['author'] = $value;
    }


    // folder ids と検索キーから記事を取得するクエリを返す
    public static function getClippingsFromFolderIds(string $searchKey = null, $folderIds)
    {
        return self::whereHas('folders', function ($q) use ($folderIds) {
            $q->whereIn('folder_id', $folderIds);
        })->where('title', 'like', '%'.$searchKey.'%');
    }

    // 取得するコメント数	commentsデータを最新のものから取得	コメントデータ
    public function newestComments(int $length = 10)
    {
        return $this->comments()->limit($length)->latest()->get();
    }

    public function setPublishedAtAttribute($value)
    {
        // utcからdatetimeへ変換
        $dt = new \DateTime($value);
        $tz = new \DateTimeZone('Asia/Tokyo');
        
        $dt->setTimezone($tz);
        $this->attributes['published_at'] = $dt->format('Y-m-d H:i:s');
    }

    // 記事のURL 又は ID	URLかIDから該当する記事データを取得	記事データ
    public function getArticle($key)
    {
        if ($this->isURL($key)) {
            return $this->with('newsSite.category')->where('url', $key)->first();
        } elseif (is_int($key)) {
            return $this->with('newsSite.category')->find($key);
        }

        return false;
    }
    
    protected function isURL($url)
    {
        return filter_var($url, FILTER_VALIDATE_URL);
    }


    // 記事データ	データから読み終えるまでの時間を	時間値
    // 計算（分単位）
    // 500文字／分　で計算
    public function calcReadingLength($content = null, $isHtml = true)
    {
        if (empty($content)) {
            // $content = $this->content;
            return $this->readingLength = null;
        }
        if ($isHtml) {
            $dom = new \DOMDocument;
            $dom->loadXML('<div>' . $content . '</div>');
            
            if (empty($dom->textContent)) {
                // $content = $this->content;
                return  $this->calcReadingLength($content, false) / 3;
            }
            $length = mb_strlen($dom->textContent);
        } else {
            $length = mb_strlen($content);
        }
        return $this->readingLength = round($length / static::$countsPerMin, 1);
    }
}
