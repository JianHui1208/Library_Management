<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSystemSettingsTable extends Migration
{
    public function up()
    {
        Schema::create('system_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable();
            $table->string('layout')->nullable();
            $table->string('type')->nullable();
            $table->string('key')->unique();
            $table->string('value')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
