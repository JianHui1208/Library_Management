<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToBookLoansTable extends Migration
{
    public function up()
    {
        Schema::table('book_loans', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_5650201')->references('id')->on('users');
            $table->unsignedBigInteger('book_id')->nullable();
            $table->foreign('book_id', 'book_fk_5650202')->references('id')->on('book_lists');
        });
    }
}
