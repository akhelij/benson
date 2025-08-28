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
        Schema::table('orders', function (Blueprint $table) {
            $table->string('telephone', 20)->nullable()->change();
            $table->string('ville', 100)->nullable()->change();
            $table->string('firm', 100)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('telephone', 20)->nullable(false)->change();
            $table->string('ville', 100)->nullable(false)->change();
            $table->string('firm', 100)->nullable(false)->change();
        });
    }
};
