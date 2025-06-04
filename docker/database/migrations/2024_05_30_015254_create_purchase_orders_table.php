<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id');
            $table->date('date');
            $table->bigInteger('salesperson_id');
            $table->string('address');
            $table->integer('days');
            $table->decimal('subtotal');
            $table->decimal('discount')->nullable();
            $table->decimal('discount_percentage')->nullable();
            $table->string('discount_message')->nullable();
            $table->decimal('iva');
            $table->decimal('total');            
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
        Schema::dropIfExists('purchase_orders');
    }
}
