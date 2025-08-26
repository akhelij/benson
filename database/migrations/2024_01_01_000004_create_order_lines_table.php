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
        Schema::create('order_lines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
            $table->string('article', 100);
            $table->string('forme', 100)->nullable();
            $table->string('client', 100)->nullable();
            $table->string('semelle', 100)->nullable();
            $table->string('construction', 100)->nullable();
            $table->string('cuir', 100)->nullable();
            $table->string('doublure', 100)->nullable();
            $table->string('supplement', 100)->nullable();
            
            // Sizes columns (p5 to p13 with halfs)
            $table->integer('p5')->default(0);
            $table->integer('p5x')->default(0);
            $table->integer('p6')->default(0);
            $table->integer('p6x')->default(0);
            $table->integer('p7')->default(0);
            $table->integer('p7x')->default(0);
            $table->integer('p8')->default(0);
            $table->integer('p8x')->default(0);
            $table->integer('p9')->default(0);
            $table->integer('p9x')->default(0);
            $table->integer('p10')->default(0);
            $table->integer('p10x')->default(0);
            $table->integer('p11')->default(0);
            $table->integer('p11x')->default(0);
            $table->integer('p12')->default(0);
            $table->integer('p13')->default(0);
            
            $table->decimal('prix', 10, 2)->nullable();
            $table->string('devise', 20)->nullable();
            $table->string('talon', 50)->nullable();
            $table->string('finition', 50)->nullable();
            $table->string('lacet', 50)->nullable();
            $table->decimal('lacetx', 10, 2)->nullable();
            $table->string('perforation', 50)->nullable();
            $table->boolean('fleur')->default(false);
            $table->text('image')->nullable();
            $table->string('langue', 10)->default('français');
            $table->enum('genre', ['homme', 'femme'])->default('homme');
            $table->boolean('livre')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_lines');
    }
};
