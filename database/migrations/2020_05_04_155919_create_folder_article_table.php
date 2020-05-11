<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFolderArticleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('folder_article', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('folder_id');
            $table->unsignedBigInteger('article_id');
            $table->timestamps();

            // 外部キー制約
            $table->foreign('folder_id')->references('id')->on('folders')->onDelete('cascade');
            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');

            // folder_idとarticle_idの組み合わせの重複を許さない
            $table->unique(['folder_id', 'article_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('folder_article');
    }
}
