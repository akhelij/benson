<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('order_lines', function (Blueprint $table) {
            // Add new foreign key columns
            $table->foreignId('article_id')->nullable()->after('order_id')->constrained('articles');
            $table->foreignId('cuir_id')->nullable()->after('construction')->constrained('cuirs');
            $table->foreignId('doublure_id')->nullable()->after('cuir_id')->constrained('doublures');
            $table->foreignId('semelle_id')->nullable()->after('forme')->constrained('semelles');
            $table->foreignId('construction_id')->nullable()->after('semelle_id')->constrained('constructions');
            
            // Add total_quantity column
            $table->integer('total_quantity')->default(0)->after('p13');
            
            // Rename supplement to supplements (plural)
            $table->renameColumn('supplement', 'supplements');
        });
    }

    public function down(): void
    {
        Schema::table('order_lines', function (Blueprint $table) {
            $table->dropForeign(['article_id']);
            $table->dropForeign(['cuir_id']);
            $table->dropForeign(['doublure_id']);
            $table->dropForeign(['semelle_id']);
            $table->dropForeign(['construction_id']);
            
            $table->dropColumn(['article_id', 'cuir_id', 'doublure_id', 'semelle_id', 'construction_id', 'total_quantity']);
            
            $table->renameColumn('supplements', 'supplement');
        });
    }
};
