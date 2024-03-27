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
        Schema::create('assign_orders', function (Blueprint $table) {
            $table->id();

            $table->foreignId('order_id')
            ->constrained('orders')
            ->onUpdate('cascade');


            $table->foreignId('employee_id')
            ->constrained('employees')
            ->onUpdate('cascade');

            $table->unsignedInteger('assigned_quantity')->default(0);
            $table->unsignedInteger('defect_quantity')->default(0);
            $table->unsignedInteger('completed_quantity')->default(0);
            $table->unsignedInteger('on_progress')->default(0);
            $table->double('rate',15,2)->default(0);
            $table->double('amount',15,2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assign_orders');
    }
};
