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
        Schema::create('characters', function (Blueprint $table) {
            $table->id();
            $table->string("name")->unique();
            $table->string("wiki_url")->nullable();
            $table->string("race")->nullable();
            $table->string("birth")->nullable();
            $table->string("gender")->nullable();
            $table->string("death")->nullable();
            $table->string("hair")->nullable();
            $table->string("height")->nullable();
            $table->string("realm")->nullable();
            $table->string("spouse")->nullable();
            $table->string("api_id")->index()->references('api_id')->on('light_characters');
            $table->integer('full_fetched')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('characters');
    }
};
