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
        Schema::create('decision_makers', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('post_nominative_letters')->nullable();
            $table->integer('hop_member_id')->nullable();
            $table->string('display_name')->nullable();
            $table->string('current_party')->nullable();
            $table->string('gender')->nullable();
            $table->boolean('is_current')->default(true);
            $table->boolean('is_active')->default(true);
            $table->boolean('is_suspended')->default(false);
            $table->boolean('is_deceased')->default(false);
            $table->boolean('is_retired')->default(false);
            $table->string('thumbnail_url')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('decision_makers');
    }
};
