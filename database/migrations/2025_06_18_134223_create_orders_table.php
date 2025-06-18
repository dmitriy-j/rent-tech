<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    Schema::create('orders', function (Blueprint $table) {
        $table->id();
        $table->foreignId('tenant_id')->constrained('users')->onDelete('cascade');
        $table->foreignId('equipment_id')->constrained('equipment')->onDelete('cascade');
        $table->dateTime('start_time');
        $table->dateTime('end_time');
        $table->decimal('total_price', 10, 2);
        $table->enum('status', ['pending', 'active', 'completed', 'cancelled']);
        $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
