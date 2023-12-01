<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('three_word_q_and_a', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->dateTime('sent_at')->default(Carbon::now());
            $table->string('q_word_1', 255);
            $table->string('q_word_2', 255);
            $table->string('q_word_3', 255);
            $table->dateTime('answered_at')->nullable();
            $table->string('a_word_1', 255)->nullable();
            $table->string('a_word_2', 255)->nullable();
            $table->string('a_word_3', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('three_word_q_and_a');
    }
};
