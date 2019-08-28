<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDialogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dialogs', function (Blueprint $table) {
            $table->bigInteger('id')->index();
            $table->bigInteger('recId')->index();
            $table->integer('recType')->index();
            $table->string('sender')->nullable();
            $table->string('dialogId')->nullable();
            $table->dateTime('addTime')->nullable();
            $table->text('recContent')->nullable();
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
        Schema::dropIfExists('dialogs');
    }
}
