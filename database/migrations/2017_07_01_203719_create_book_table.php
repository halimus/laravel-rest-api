<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('book_id');
            $table->string('title', 100)->nullable(false);
            $table->string('slug', 100)->nullable();
            $table->text('description')->nullable();
            $table->string('ISBN', 20)->nullable();
            $table->smallInteger('pages')->unsigned();
            //$table->timestamp('published_at')->useCurrent();
            $table->date('published_at')->nullable();
            $table->timestamps();
            
            $table->integer('language_id')->unsigned();
            $table->integer('author_id')->unsigned();
            
            $table->foreign('language_id')
                  ->references('language_id')
                  ->on('languages');
            
            $table->foreign('author_id')
                  ->references('author_id')
                  ->on('author')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::dropIfExists('book');
    }
}
