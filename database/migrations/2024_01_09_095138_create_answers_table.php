<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->uuid('id')->unique();
            $table->uuid('user_id');
            $table->unsignedBigInteger('question_id');
            $table->unsignedBigInteger('comunity_category_id');
            $table->longText('jawaban');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict');
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
            $table->foreign('comunity_category_id')->references('id')->on('comunity_categories')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('answers');
    }
};
