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

        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('external_game_id')->nullable()->unique()->comment('Auxilio para sincronia nas importacoes');
            $table->date('date');
            $table->year('season');
            $table->string('status', 12);
            $table->unsignedInteger('period');
            $table->string('time', 12);
            $table->boolean('postseason')->default(false);
            $table->unsignedInteger('home_team_score')->default(0);
            $table->unsignedInteger('visitor_team_score')->default(0);
            
            $table->unsignedBigInteger('team_home_id');
            $table->foreign('team_home_id')->references('id')->on('teams');

            $table->unsignedBigInteger('team_visitor_id');
            $table->foreign('team_visitor_id')->references('id')->on('teams');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
