<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vending_machines', function (Blueprint $table) {
            // Check if 'picture' column exists before attempting to drop it
            if (Schema::hasColumn('vending_machines', 'maker')) {
                $table->dropColumn('maker');
            }
        });
    }
};