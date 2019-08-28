<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeAddMessageTableIndex extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->index('data_type');
            $table->index('visitorSendNum');
            $table->index('keyword');
            $table->index('preVisitTime');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->dropIndex(['data_type']);
            $table->dropIndex(['visitorSendNum']);
            $table->dropIndex(['keyword']);
            $table->dropIndex(['preVisitTime']);
        });
    }
}
