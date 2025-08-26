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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('code', 100)->unique();
            $table->string('firm', 100);
            $table->string('ville', 100);
            $table->string('telephone', 20);
            $table->date('livraison');
            $table->string('transporteur', 100)->nullable();
            $table->string('boite', 250)->nullable();
            $table->string('logo')->nullable();
            $table->string('logo1')->nullable();
            $table->text('notes')->nullable();
            $table->text('transort')->nullable();
            $table->enum('status', ['draft', 'confirmed', 'in_production', 'delivered', 'cancelled'])->default('draft');
            $table->decimal('total_amount', 10, 2)->default(0);
            $table->string('currency', 3)->default('EUR');
            $table->integer('total_quantity')->default(0);
            $table->boolean('is_urgent')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
