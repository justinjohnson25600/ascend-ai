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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('organisation')->nullable();
            $table->enum('enquiry_type', ['investment', 'partnership', 'advisory', 'general']);
            $table->text('message');
            $table->boolean('is_responded')->default(false);
            $table->timestamp('responded_at')->nullable();
            $table->timestamps();

            $table->index('email');
            $table->index('enquiry_type');
            $table->index('is_responded');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
