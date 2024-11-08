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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('blogger');
            $table->integer('blogger_id');
            $table->integer('category_id');
            $table->string('title');
            $table->string('tags');
            $table->string('sub_title');
            $table->longText('description');
            $table->string('slug')->nullable();
            $table->string('thumbnail');
            $table->integer('status')->default(0);
            $table->integer('view')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
