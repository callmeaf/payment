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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(config('callmeaf-user.model'))->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor(config('callmeaf-order.model'))->nullable()->constrained()->nullOnDelete();
            $table->string('status')->nullable();
            $table->string('type')->nullable();
            $table->string('method')->nullable();
            $table->string('ref_code')->nullable();
            $table->string('tr_code')->nullable();
            $table->string('total_price')->nullable();
            $table->softDeletes();
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
