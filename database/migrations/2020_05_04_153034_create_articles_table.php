<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('description');
            $table->string('url')->unique();
            $table->string('url_to_image')->nullable();
            $table->timestamp('published_at');
            $table->text('content')->nullable();
            $table->unsignedBigInteger('news_site_id');
            $table->integer('volume')->default(0);
            $table->string('author')->nullable();
            $table->timestamps();

            $table->foreign('news_site_id')->references('id')->on('news_sites')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
