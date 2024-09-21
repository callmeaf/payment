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
        Schema::create('payment_items', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(config('callmeaf-payment.model'))->constrained()->cascadeOnDelete();
            $table->foreignIdFor(config('callmeaf-variation.model'))->nullable()->constrained()->nullOnDelete();
            $table->string('status')->nullable();
            $table->string('type')->nullable();
            $table->string('price')->nullable();
            $table->string('discount_price')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
