<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('review_criteria', function (Blueprint $table) {
            $table->id();
            $table->string('status')->default('draft'); // Status for draft or published
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('review_criteria');
    }
};
