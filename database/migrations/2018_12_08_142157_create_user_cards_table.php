<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_cards', function (Blueprint $table) {
            $table->increments('id');
            $table->string('visitorId',50)->comment('访客ID，访客的唯一标识')->nullable();
            $table->string('linkman',50)->comment('联系人名称')->nullable();
            $table->bigInteger('cusType')->comment("访客类型（值在客户类型定义）")->nullable();
            $table->string('compName',50)->comment("公司名称")->nullable();
            $table->string('webUrl')->comment("网址")->nullable();
            $table->string('mobile',50)->comment("手机")->nullable();
            $table->string('phone',50)->comment("电话")->nullable();
            $table->string('qq',50)->comment("电话")->nullable();
            $table->string('msn',200)->comment("MSN/微信")->nullable();
            $table->string('email',200)->comment("邮箱")->nullable();
            $table->string('address',200)->comment("地址")->nullable();
            $table->string('birthday',30)->comment("生日")->nullable();
            $table->string('birthday',30)->comment("生日")->nullable();
            $table->string('col1',500)->comment('自定义字段1')->nullable();
            $table->string('col2',500)->comment('自定义字段2')->nullable();
            $table->string('col3',500)->comment('自定义字段3')->nullable();
            $table->string('col4',500)->comment('自定义字段4')->nullable();
            $table->string('col5',500)->comment('自定义字段5')->nullable();
            $table->string('col6',500)->comment('自定义字段6')->nullable();
            $table->string('col7',500)->comment('自定义字段7')->nullable();
            $table->string('col8',500)->comment('自定义字段8')->nullable();
            $table->string('col9',500)->comment('自定义字段9')->nullable();
            $table->string('remark',1000)->comment('备注')->nullable();
            $table->string('loginName' , 50)->comment('所属客服（登录名）')->nullable();
            $table->string('userName' , 50)->comment('所属客服（姓名）')->nullable();
            $table->string('nickName' , 50)->comment('所属客服（昵称）')->nullable();
            $table->timestamp('addtime')->nullable();
            $table->timestamp('lastChangeTime')->nullable();
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
        Schema::dropIfExists('user_cards');
    }
}
