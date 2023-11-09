<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi', function(Blueprint $table){
            $table->id();
            $table->biginteger('id_produk')->unsigned();
            $table->biginteger('id_customer')->unsigned();
            $table->biginteger('qty');
            $table->date('transaksi_date');
            $table->decimal('harga',20,2);
            $table->boolean('is_void');
            $table->foreign('id_produk')->references('id')->on('produk')->onDelete('cascade');
            $table->foreign('id_customer')->references('id')->on('customer')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};