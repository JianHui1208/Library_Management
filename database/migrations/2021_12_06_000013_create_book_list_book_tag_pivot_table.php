<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookListBookTagPivotTable extends Migration
{
    public function up()
    {
        Schema::create('book_list_book_tag', function (Blueprint $table) {
            $table->unsignedBigInteger('book_list_id');
            $table->foreign('book_list_id', 'book_list_id_fk_5507393')->references('id')->on('book_lists')->onDelete('cascade');
            $table->unsignedBigInteger('book_tag_id');
            $table->foreign('book_tag_id', 'book_tag_id_fk_5507393')->references('id')->on('book_tags')->onDelete('cascade');
        });
    }
}
