<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToBookListsTable extends Migration
{
    public function up()
    {
        Schema::table('book_lists', function (Blueprint $table) {
            $table->unsignedBigInteger('book_category_id')->nullable();
            $table->foreign('book_category_id')->references('id')->on('book_categories');
        });
    }
}
