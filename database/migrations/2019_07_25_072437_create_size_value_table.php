<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSizeValueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('size_value', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('value',255);
            $table->bigInteger('size')->nullable();
            $table->char('status')->default(1)->comment('1 = Active, 2 = InActive');
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
        Schema::dropIfExists('size_value');
    }
}
