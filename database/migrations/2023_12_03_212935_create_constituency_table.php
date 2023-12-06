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
        Schema::create('constituencies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('nation');
            $table->unsignedInteger('population')->nullable();
            $table->string('incumbent_party')->nullable();
            $table->unsignedBigInteger('constituency_type_id');
            $table->timestamps();
            $table->foreign('constituency_type_id')
                  ->references('id')
                  ->on('constituency_types')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('constituencies');
    }
};