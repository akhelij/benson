<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('order_lines', function (Blueprint $table) {
            // First, add a temporary boolean column
            $table->boolean('perforation_new')->default(false)->after('perforation');
        });

        // Convert existing string data to boolean
        DB::statement("
            UPDATE order_lines 
            SET perforation_new = CASE 
                WHEN perforation IS NOT NULL AND perforation != '' AND perforation != 'Sans' THEN 1 
                ELSE 0 
            END
        ");

        Schema::table('order_lines', function (Blueprint $table) {
            // Drop old column and rename new one
            $table->dropColumn('perforation');
        });

        Schema::table('order_lines', function (Blueprint $table) {
            $table->renameColumn('perforation_new', 'perforation');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_lines', function (Blueprint $table) {
            // Add temporary string column
            $table->string('perforation_old', 50)->nullable()->after('perforation');
        });

        // Convert boolean back to string (data loss will occur)
        DB::statement("
            UPDATE order_lines 
            SET perforation_old = CASE 
                WHEN perforation = 1 THEN 'Oui' 
                ELSE NULL 
            END
        ");

        Schema::table('order_lines', function (Blueprint $table) {
            $table->dropColumn('perforation');
        });

        Schema::table('order_lines', function (Blueprint $table) {
            $table->renameColumn('perforation_old', 'perforation');
        });
    }
};
