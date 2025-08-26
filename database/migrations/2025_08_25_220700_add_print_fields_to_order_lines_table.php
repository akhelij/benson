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
        Schema::table('order_lines', function (Blueprint $table) {
            // Check if columns don't exist before adding them
            if (!Schema::hasColumn('order_lines', 'pointure')) {
                $table->string('pointure')->nullable()->after('genre');
            }
            if (!Schema::hasColumn('order_lines', 'vpointure')) {
                $table->integer('vpointure')->default(0)->after('pointure');
            }
            if (!Schema::hasColumn('order_lines', 'trepointe')) {
                $table->string('trepointe')->nullable()->after('lacetx');
            }
            if (!Schema::hasColumn('order_lines', 'trepointe_img')) {
                $table->string('trepointe_img')->nullable()->after('trepointe');
            }
            if (!Schema::hasColumn('order_lines', 'perforation')) {
                $table->boolean('perforation')->default(false)->after('trepointe_img');
            }
            if (!Schema::hasColumn('order_lines', 'dentlage')) {
                $table->boolean('dentlage')->default(false)->after('perforation');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_lines', function (Blueprint $table) {
            $table->dropColumn(['pointure', 'vpointure', 'trepointe', 'trepointe_img', 'perforation', 'dentlage']);
        });
    }
};
