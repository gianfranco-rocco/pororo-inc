<?php

declare(strict_types=1);

use Domain\Questions\Models\QuestionAnswer;
use Domain\Users\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_answers', function (Blueprint $table) {
            $table->id();
            $table
                ->foreignIdFor(User::class, 'patient_id')
                ->constrained('users');
            $table
                ->foreignIdFor(QuestionAnswer::class, 'question_answer_id')
                ->constrained();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_answers');
    }
};
