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
            $table->integer('p12x')->default(0)->after('p12');
            $table->integer('p13x')->default(0)->after('p13');
            $table->integer('p14')->default(0)->after('p13x');
            $table->integer('p14x')->default(0)->after('p14');
            $table->integer('p15')->default(0)->after('p14x');
            $table->integer('p16')->default(0)->after('p15');
            $table->integer('p17')->default(0)->after('p16');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_lines', function (Blueprint $table) {
            $table->dropColumn(['p12x', 'p13x', 'p14', 'p14x', 'p15', 'p16', 'p17']);
        });
    }
};
