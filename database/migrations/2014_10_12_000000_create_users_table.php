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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('location')->nullable();
            $table->string('hometown')->nullable();
            $table->text('bio')->nullable();
            $table->string('handle')->nullable();
            $table->string('job_title')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('is_verified')->default(false);
            $table->boolean('is_active')->default(true);
            $table->boolean('is_protected')->default(false);
            $table->boolean('is_suspended')->default(false);
            $table->boolean('is_banned')->default(false);
            $table->boolean('is_deleted')->default(false);
            $table->boolean('is_flagged')->default(false);
            $table->string('gender')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('phone')->nullable();
            $table->string('thumbnail_url')->nullable();
            $table->string('cover_url')->nullable();
            $table->integer('primary_constituency_id')->default(0);
            $table->integer('primary_political_party_id')->default(0);
            $table->boolean('is_decision_maker')->default(false);
            $table->boolean('is_mayor')->default(false);
            $table->boolean('is_mp')->default(false);
            $table->boolean('is_governor')->default(false);
            $table->boolean('is_senator')->default(false);
            $table->boolean('is_president')->default(false);
            $table->boolean('is_vip')->default(false);
            $table->boolean('is_team_member')->default(false);
            $table->boolean('is_team_leader')->default(false);
            $table->boolean('is_team_admin')->default(false);
            $table->boolean('is_team_owner')->default(false);
            $table->boolean('is_featured')->default(false);
            $table->integer('followers_count')->default(0);
            $table->integer('following_count')->default(0);
            $table->integer('posts_count')->default(0);
            $table->integer('comments_count')->default(0);
            $table->integer('likes_count')->default(0);
            $table->integer('dislikes_count')->default(0);
            $table->integer('shares_count')->default(0);
            $table->integer('flags_count')->default(0);
            $table->integer('views_count')->default(0);
            $table->timestamp('last_login_at')->nullable();
            $table->string('last_login_ip')->nullable();
            $table->string('last_login_device')->nullable();
            $table->string('last_login_location')->nullable();
            $table->string('last_login_country')->nullable();
            $table->string('last_login_region')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
