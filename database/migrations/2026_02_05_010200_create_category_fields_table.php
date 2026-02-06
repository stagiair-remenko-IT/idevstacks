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
        Schema::create('category_fields', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('category_id')
                ->constrained()
                ->cascadeOnDelete();
            // Machine-readable key used in the document meta payload
            $table->string('key');
            // Human-friendly label shown in the UI
            $table->string('label');
            // Simple field type for rendering: text, textarea, password, number, url, etc.
            $table->string('field_type', 50)->default('text');
            $table->boolean('is_sensitive')->default(false);
            $table->boolean('is_required')->default(false);
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->text('help_text')->nullable();
            $table->timestamps();

            $table->unique(['category_id', 'key']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_fields');
    }
};

