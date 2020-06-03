<a href="https://github.com/laravel/laravel"><img src="https://img.shields.io/badge/laravel-6.*-brightgreen.svg?style=flat-square" alt="laravel"></a>
<img src="https://img.shields.io/badge/license-MIT-green.svg?style=flat-square" alt="license">

# NewsApp

## 概要

[NewsAPI](https://newsapi.org/)で提供されているニュースを読み込んで一覧で表示するアプリです。配信元を自由に設定し、好みの記事をクリップして保存できます。Laravelで作成し、読み込んだヘッドラインデータをDBに保存します。

## 特徴

- 登録したニュースソースごとにヘッドラインニュースを一覧表示
- ニュース記事で気に入ったものをお気に入りとしてフォルダに保存
- また、記事ごとに星評価を設定できる
- 記事詳細ページでは、元のウェブページの本文を自動で読み込んで表示（一部サイトで読み込みが上手くいかないことも）。
- 記事詳細ページにはコメント一覧と投稿フォームがあり、自由にコメントを追加可能
- ログイン認証機能

## NewsAPI

[NewsAPI](https://newsapi.org/)では、APIを使って世界中のニュースサイトのヘッドライン情報を取得できます。なお、APIを利用するためにはNewsAPIの[サイト](https://newsapi.org/)でアカウント登録し、トークンを発行する必要があります。

### アプリ内のトークンの設定

```bash
# .envファイル内
API_KEY=[作成したトークン文字列]
```

## インストール方法

```bash
# プロジェクトをクローン
git clone https://github.com/tekku-taro/newsapp.git

# ディレクトリに移動
cd newsapp

# PHPのパッケージをcomposerでインストール
composer install

# .envを作成してDB情報を編集
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mydb
DB_USERNAME=root
DB_PASSWORD=

# アプリケーションキーの設定
php artisan key:generate

# マイグレーションとシーダーの実行
php artisan migrate --seed

# npmパッケージのインストール
npm install

# アセットのコンパイル
npm run dev

# NewsAPIのトークンを.env内に記録
API_KEY=[作成したトークン文字列]
```



## ニュースソースの設定

データベースのシーダーにいくつかニュースソースが設定されていますのが、さらに好みのニュースソースを追加できます。

> 配信サイトメニュー >> 新規登録画面

### フォームの入力内容

```bash
URL:ニュース配信元のURL
サイト名称：配信ソース名（自由に設定）
# ソースか国名＋カテゴリのどちらかを設定
ソース：決められた名前（下を参照）
国名：リストから選択
カテゴリ：リストから選択
表示数：ニュース一覧で表示されるニュースの数
```

ソースの具体的な名前を調べるには、NewsAPIサイトに[News sources](https://newsapi.org/sources)ページがあります。ページ内のLive examplesで表示されている記事データの中の`source.name`がソース名になります。

## ライセンス (License)

**NewsApp**は[MIT license](https://opensource.org/licenses/MIT)のもとで公開されています。 

**NewsApp** is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).