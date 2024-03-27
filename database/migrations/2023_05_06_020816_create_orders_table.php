<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**`
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('avatar')->default('path to image/Image Name');
            $table->string('name')->default('Order Name');
            $table->unsignedInteger('quantity')->nullable()->default(0);
            $table->double('rate', 15, 2)->nullable()->default(0.0);
            $table->double('advance_payment', 15, 2)->nullable()->default(0.0);
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
