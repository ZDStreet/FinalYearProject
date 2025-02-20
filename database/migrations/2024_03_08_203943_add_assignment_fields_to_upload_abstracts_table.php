<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAssignmentFieldsToUploadAbstractsTable extends Migration
{
    public function up()
    {
        Schema::table('upload_abstracts', function (Blueprint $table) {
            $table->string('status')->default('pending');
            $table->unsignedBigInteger('reviewer_id')->nullable();
            $table->foreign('reviewer_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('upload_abstracts', function (Blueprint $table) {
            $table->dropForeign(['reviewer_id']);
            $table->dropColumn(['status', 'reviewer_id']);
        });
    }
}

