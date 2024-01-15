<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
/*{

    public function down(): void
    {
        Schema::table('vending_machines', function (Blueprint $table) {
            // Check if 'picture' column exists before attempting to drop it
            if (Schema::hasColumn('vending_machines', 'picture')) {
                $table->dropColumn('picture');
            }
        });
    }
};
*/

{

    public function up()
    {
        Schema::table('vending_machines', function (Blueprint $table) {
            $table->dropColumn('category_id');
        });
    }

    public function down(): void
    {
        Schema::table('vending_machines', function (Blueprint $table) {
            //
        });
    }
};

