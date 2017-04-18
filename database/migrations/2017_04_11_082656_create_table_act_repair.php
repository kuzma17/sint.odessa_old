<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableActRepair extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('act_repairs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id');
            $table->integer('status_repair_id');
            $table->string('device', 255);
            $table->text('set_device');
            $table->text('text_defect');
            $table->text('diagnostic');
            $table->string('cost', 255);
            $table->text('comment');
            $table->integer('user_consent_id');
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
        Schema::dropIfExists('act_repairs');
    }
}
