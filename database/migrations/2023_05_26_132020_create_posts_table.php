<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->integer('author_id')->nullable();
            $table->integer('category_id')->nullable();
            $table->string('post_title')-> nullable();
            $table->string('post_slug')->nullable();
            $table->text('post_content')->nullable();
            $table->string('seo_baslik')->nullable();
            $table->string('seo_etiket')->nullable();
            $table->string('seo_icerik')->nullable();
            $table->string('video')->nullable();
            $table->string('barkod')->nullable();
            $table->string('fiyat_indirimli')->nullable();
            $table->string('fiyat')->nullable();
            $table->string('stok_kodu')->nullable();
            $table->string('sayfa_gorsel')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
};
