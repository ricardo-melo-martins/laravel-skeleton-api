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
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('external_player_id')->nullable()->comment('Auxilio para sincronia nas importacoes');            
            $table->string('first_name', 45);
            $table->string('last_name', 120);
            $table->string('position', 1);
            $table->string('height', 4);
            $table->string('weight', 4);
            $table->string('jersey_number', 4);
            $table->string('college', 120);
            $table->string('country', 120);
            $table->year('draft_year')->nullable();
            $table->unsignedTinyInteger('draft_round', false)->nullable();
            $table->unsignedTinyInteger('draft_number', false)->nullable();

            $table->unsignedBigInteger('team_id');
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('players');
    }
};
