<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSecondSubCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('second_category', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',255);
            $table->integer('category_id');
            $table->integer('first_category_id');
            $table->char('status', 1)->comment('1 = Active, 2 = InActive')->default(1);
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
        Schema::dropIfExists('second_sub_category');
    }
}
