<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProductColumnToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('customer_surname', 80);
            $table->string('customer_address');
            $table->string('product_name');
            $table->double('product_price');
            $table->bigInteger('product_quantity');
            $table->double('total');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->removeColumn('customer_surname');
            $table->removeColumn('customer_address');
            $table->removeColumn('product_name');
            $table->removeColumn('product_price');
            $table->removeColumn('product_quantity');
        });
    }
}
