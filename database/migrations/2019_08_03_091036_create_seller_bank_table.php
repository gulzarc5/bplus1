<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSellerBankTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seller_bank', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('seller_id');
            $table->string('bank_name')->nullable();
            $table->string('branch_name')->nullable();
            $table->string('account')->nullable();
            $table->string('ifsc')->nullable();
            $table->string('micr')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('seller_bank');
    }
}
