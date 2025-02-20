<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('review_sections', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('review_criteria_id'); // Ensure this matches the actual primary key data type.
            $table->string('title');
            $table->text('explanation')->nullable();
            $table->integer('max_grade');
            $table->integer('order');
            $table->timestamps();
        
            $table->foreign('review_criteria_id')
                  ->references('id')->on('review_criteria') // This should match exactly the created table name.
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('review_sections');
    }
};
