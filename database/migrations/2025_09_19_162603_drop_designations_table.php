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
        Schema::dropIfExists('designations');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No need to recreate the table, as we've decided to remove this feature
    }
};
