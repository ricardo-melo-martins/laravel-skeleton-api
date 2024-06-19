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
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('external_team_id')->comment('Auxilio para sincronia nas importacoes');            
            $table->string('conference', 45)->nullable();
            $table->string('division', 120)->nullable();
            $table->string('city', 120)->nullable();
            $table->string('name', 120);
            $table->string('full_name', 120);
            $table->string('abbreviation', 3);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teams');
    }
};
