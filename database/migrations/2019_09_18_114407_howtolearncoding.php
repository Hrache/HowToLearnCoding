<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class Howtolearncoding extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    /*  WEBSITES  */
    Schema::create('websites', function (Blueprint $table) {
      $table->tinyIncrements('id');
      $table->tinyInteger('rank')->unsigned();
      $table->string('title', 128)->nullable(false)->unique();
      $table->string('descriptor', 128)->nullable(false)->unique();
      $table->string('external_url', 255)->nullable(false)->unique();
      $table->timestamps();
      $table->collation = 'utf8_general_ci';
      $table->charset = 'utf8';
    });

    /*  ARTICLES  */
    Schema::create('articles', function (Blueprint $table) {
      $table->smallIncrements('id');
      $table->enum('role', ['intro', 'body', 'last', 'extra']);
      $table->text('title')->nullable(false);
      $table->text('article')->nullable(false);
      $table->unsignedTinyInteger('website_id')->nullable(true);
      $table->foreign('website_id')->references('id')->on('websites')->onUpdate('cascade')->onDelete('set null');
      $table->timestamps();
      $table->collation = "utf8_general_ci";
      $table->charset = "utf8";
    });

    /*  COMMENTS  */
    Schema::create('comments', function (Blueprint $table) {
      $table->increments('id');
      $table->string('author', 191)->nullable(false);
      $table->string('email', 255)->nullable(false);
      $table->text('content')->nullable(false);
      $table->tinyInteger('website_id')->nullable(true)->unsigned();
      $table->foreign('website_id')->references('id')->on('websites')->onUpdate('cascade')->onDelete('set null');
      $table->timestamps();
      $table->collation = 'utf8_general_ci';
      $table->charset = "utf8";
    });

    /*  Images  */
    Schema::create('images', function (Blueprint $table) {
      $table->increments('id');
      $table->string('image', 255)->nullable(false);
      $table->enum('role', ['cover', 'intro', 'body', 'last'])->nullable(false);
      $table->tinyInteger('website_id')->nullable(true)->unsigned();
      $table->foreign('website_id')->references('id')->on('websites')->onUpdate('cascade')->onDelete('set null');
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
    Schema::dropIfExists('websites');
    Schema::dropIfExists('articles');
    Schema::dropIfExists('comments');
  }
}
