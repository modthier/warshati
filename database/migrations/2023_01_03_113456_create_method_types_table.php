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
        Schema::create('method_types', function (Blueprint $table) {
            $table->id();
            $table->foreignId('method_id')->nullable()->references('id')->on('payment_methods')->onDelete('cascade');
            $table->foreignId('payment_type_id')->nullable()->references('id')->on('payment_types')->onDelete('cascade');
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
        Schema::dropIfExists('method_types');
    }
};
