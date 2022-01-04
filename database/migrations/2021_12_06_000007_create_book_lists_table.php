<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookListsTable extends Migration
{
    public function up()
    {
        Schema::create('book_lists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('uid')->unique();
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->string('language')->nullable();
            $table->integer('year')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
