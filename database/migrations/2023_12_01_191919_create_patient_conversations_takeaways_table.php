<?php

declare(strict_types=1);

use Domain\Users\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('patient_conversation_takeaways', function (Blueprint $table) {
            $table->id();
            $table->text('takeaway');
            $table
                ->foreignIdFor(User::class, 'patient_id')
                ->constrained('users');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('patient_conversation_takeaways');
    }
};
