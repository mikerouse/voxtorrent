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
        Schema::table('constituencies', function (Blueprint $table) {
            $table->string('ons_id')->nullable()->change();
            $table->integer('hop_id')->nullable();
            $table->integer('mapit_id')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->boolean('is_current')->default(true);
            $table->integer('member_count')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('constituencies', function (Blueprint $table) {
            $table->dropColumn('ons_id');
            $table->dropColumn('hop_id');
            $table->dropColumn('mapit_id');
            $table->dropColumn('start_date');
            $table->dropColumn('end_date');
            $table->dropColumn('is_current');
            $table->dropColumn('member_count');
        });
    }
};
