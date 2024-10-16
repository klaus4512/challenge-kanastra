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
        Schema::create('billets', function (Blueprint $table) {
            $table->uuid('debt_id')->primary();
            $table->date('debt_due_date');
            $table->decimal('debt_value', 15, 2);
            $table->string('email');
            $table->string('government_id');
            $table->string('name');
            $table->dateTime('billet_generated_at')->nullable();
            $table->dateTime('billet_send_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('billets');
    }
};
