<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateElectionTypesTable extends Migration
{
    public function up()
    {
        Schema::create('election_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('slug')->unique();
            $table->boolean('is_active')->default(false);
            $table->boolean('is_locked')->default(false);
            $table->boolean('is_archived')->default(false);
            $table->boolean('is_trash')->default(false);
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('last_updated_by')->constrained('users');
            $table->foreignId('trashed_by')->nullable()->constrained('users');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('election_types');
    }
}