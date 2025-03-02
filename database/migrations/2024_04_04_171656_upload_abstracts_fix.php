<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('upload_abstracts', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['reviewer_id']);

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('reviewer_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('upload_abstracts', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['reviewer_id']);
            
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('reviewer_id')->references('id')->on('users');
        });
    }
};
