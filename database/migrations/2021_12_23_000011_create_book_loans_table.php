<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookLoansTable extends Migration
{
    public function up()
    {
        Schema::create('book_loans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->datetime('expired_time')->nullable();
            $table->string('status')->nullable();
            $table->boolean('expired_pay')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
