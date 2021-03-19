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
            $table->increments('id')->unsigned();
            $table->string('title', 128);
            $table->string('slug')->unique();
            $table->string('seo_title')->nullable();
            $table->string('intro_text', 250);
            $table->string('intro_img')->nullable();
            $table->text('full_text');
            $table->text('meta_description');
            $table->text('meta_keywords');
            $table->enum('status', array('published', 'workInProgress','waitingForValidation','disabled'))->default('workInProgress');
            // not bool for add choice oneday
            $table->enum('allow_comment', array('no', 'yes'))->default('yes');
            $table->timestamp('published_at')->nullable();
            $table->integer('author_id')->unsigned()->nullable();
            $table->integer('corrector_id')->unsigned()->nullable();
            $table->integer('validator_id')->unsigned()->nullable();
            $table->integer('categorie_id')->unsigned()->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('articles', function(Blueprint $table) {
            $table->foreign('author_id')->references('id')->on('users')->nullOnDelete()->onUpdate('cascade');
            $table->foreign('corrector_id')->references('id')->on('users')->nullOnDelete()->onUpdate('cascade');
            $table->foreign('categorie_id')->references('id')->on('users')->nullOnDelete()->onUpdate('cascade');
            $table->foreign('validator_id')->references('id')->on('users')->nullOnDelete()->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('articles');
    }
}
