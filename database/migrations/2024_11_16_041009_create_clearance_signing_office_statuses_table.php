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
        Schema::create('clearance_signing_office_statuses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('clearance_id')
                ->constrained('clearances', 'clearance_id')
                ->cascadeOnDelete();
            $table->foreignId('signing_office_id')
                ->constrained('signing_offices', 'office_id')
                ->cascadeOnDelete();
            $table->boolean('is_approved')->default(false);
            $table->boolean('is_pending')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clearance_signing_office_statuses');
    }
};
