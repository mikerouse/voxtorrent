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
        Schema::create('hashtags', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->nullable();
            $table->text('description')->nullable();
            $table->foreignId('creator_id')->constrained('users');
            $table->float('weight')->default(0);
            $table->float('views')->default(0);
            $table->float('likes')->default(0);
            $table->float('shares')->default(0);
            $table->float('dislikes')->default(0);
            $table->float('flags')->default(0);
            $table->boolean('is_blocked')->default(false);
            $table->boolean('is_sensitive')->default(false);
            $table->boolean('is_trash')->default(false);
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hashtags');
    }
};
