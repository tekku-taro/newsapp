<?php
namespace App\Service;

use App\User;
use App\Folder;

class ArticleManager
{
    protected $context = [
        "http" => [
            "protocol_version" => "1.1",
            // "method"  => "POST",
            // "header"  => implode("\r\n", $header),
            // "content" => $req,
            "ignore_errors" => true
        ]
    ];

    // ☆評価を取得して追加
    // ユーザのフォルダに記事があるか、あればフォルダIDを追加
    public function decorateArticles(User $user, $articles, $addFolderId = true)
    {
        // dump($articles);
        foreach ($articles as $key => $article) {
            $stars = $user->getFavoriteScore($article->id);
            $articles[$key]->stars = $stars;
            if ($addFolderId) {
                $folderId = $user->getFolderId($article->id);
                $articles[$key]->folderId = $folderId;
            }
        }
        return $articles;
    }

    // ☆評価を取得して追加
    // ユーザのフォルダに記事があるか、あればフォルダIDを追加
    public function decorateArticle(User $user, $article, $addFolderId = true, $loadUrlContent = true)
    {
        // dump($article);

        $stars = $user->getFavoriteScore($article->id);
        $article->stars = $stars;
        if ($addFolderId) {
            $folderId = $user->getFolderId($article->id);
            $article->folderId = $folderId;
        }

        return $article;
    }

    public function getOriginalPage($url)
    {
        $original = file_get_contents($url, false, stream_context_create($this->context));

        $extracted = $this->extractArticle($original);
        // dd($original);
        return $extracted;
    }

    protected function extractArticle($original)
    {
        $extracted = '';

        $dom = new \DOMDocument;
        $dom->preserveWhiteSpace = false;
        libxml_use_internal_errors(true);

        if ($dom->loadHTML($original)) {
            $this->removeTags($dom, 'img');
            $this->removeTags($dom, 'a');
            // dd($dom->saveHTML($dom));
            $extracted .= $this->getTagContent($dom, 'article');
            if (empty($extracted)) {
                $extracted .= $this->getTagContent($dom, 'main');
            }
            if (empty($extracted)) {
                $extracted .= $this->getTagContent($dom, 'p');
            }
            if (empty($extracted)) {
                $extracted .= $dom->saveHTML($dom);
            }
            // dd($extracted);
        }

        libxml_clear_errors();
        
        return $extracted;
    }

    protected function getTagContent($dom, $name)
    {
        $extracted = '';
        $nodes = $dom->getElementsByTagName($name);
        if ($nodes->length > 0) {
            foreach ($nodes as $node) {
                $this->removeEmptyTags($node);
                $extracted .= $dom->saveHTML($node);
            }
        }
        return $extracted;
    }

    protected function removeEmptyTags($node)
    {
        $elements = $node->getElementsByTagName('*');

        foreach ($elements as $element) {
            if (!$element->hasChildNodes() && $element->nodeValue == '') {
                $element->parentNode->removeChild($element);
            }
        }
    }

    protected function removeTags($dom, $name)
    {
        $list = $dom->getElementsByTagName($name);
        
        while ($list->length > 0) {
            $elem = $list->item(0);
            $elem->parentNode->removeChild($elem);
        }
    }

    // フォルダリストを取得
    public function getFolderList(User $user)
    {
        $folderList = $user->folders()->get()->pluck('name', 'id');

        return $folderList;
    }
}
