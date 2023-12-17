<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateElectionsTable extends Migration
{
    public function up()
    {
        Schema::create('elections', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('polling_day');
            $table->integer('seats_contested')->nullable();
            $table->integer('seats_available')->nullable();
            $table->integer('seats_total')->nullable();
            $table->integer('registered_voters')->nullable();
            $table->integer('ballots_cast')->nullable();
            $table->text('description')->nullable();
            $table->string('slug')->unique();
            $table->boolean('is_active')->default(false);
            $table->boolean('is_locked')->default(false);
            $table->boolean('is_archived')->default(false);
            $table->boolean('is_trash')->default(false);
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('last_updated_by')->constrained('users');
            $table->foreignId('trashed_by')->nullable()->constrained('users');
            $table->foreignId('election_type_id')->constrained();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('elections');
    }
}