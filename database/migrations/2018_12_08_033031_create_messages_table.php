<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger("recId")->nullable()->comment('访客回话信息的唯一标识');
            $table->string("visitorId", 32)->nullable()->comment('访客ID，访客的唯一标识')->index();
            $table->string("visitorName", 50)->nullable()->comment('访客名称');
            $table->timestamp("curEnterTime")->nullable()->comment('当前进入网站时间');
            $table->integer("curStayTime")->nullable()->comment('访客停留时间（秒 ）');
            $table->string("sourceIp", 50)->nullable()->comment('访客来源IP');
            $table->string("sourceProvince", 30)->nullable()->comment('来源省市');
            $table->string("sourceIpInfo", 100)->nullable()->comment('访客来源IP信息（网络接入商）');
            $table->string("requestType", 10)->nullable()->comment('对话请求方式（rt_v：访客请求，rt_c：客服请求，rt_ct：本公司跨站点转接，rt_ot：跨公司转接）');
            $table->string("endType", 10)->nullable()->comment('对话结束方式（et_v_e：访客主动结束，et_c_e：客服主动结束，et_c_r：客服拒绝对话，et_t_s：跨站点转接转出，et_t_c：跨公司转接转出，et_c_o：客服网络断网，et_c_q：客服退出系统，et_d_t：对话状态超时）');
            $table->timestamp("diaStartTime")->nullable()->comment('对话开始时间');
            $table->timestamp("diaEndTime")->nullable()->comment('对话结束时间');
            $table->string("terminalType", 10)->nullable()->comment('终端类型（tt_pc：电脑，tt_ppc：平板电脑，tt_mb：手机）');
            $table->integer("visitorSendNum")->nullable()->comment('访客发送消息数');
            $table->integer("csSendNum")->nullable()->comment('客服发送消息数');
            $table->string("sourceUrl", 1500)->nullable()->comment('来源网页');
            $table->string("sourceType", 10)->nullable()->comment('来源类型');
            $table->string("searchEngine", 30)->nullable()->comment('搜索引擎');
            $table->string("keyword", 100)->nullable()->comment('搜索关键词');
            $table->string("firstCsId", 50)->nullable()->comment('初次接待客服');
            $table->string("joinCsIds", 500)->nullable()->comment('参与接待客服');
            $table->string("dialogType", 10)->nullable()->comment('对话类型（dt_v_ov：仅访问网站，dt_v_nm：访客无消息，dt_c_na：客服未接受，dt_c_nm：客服无消息，dt_d_o：其他有效对话，dt_d_n：一般对话，dt_d_g：较好对话，dt_d_b：更好/极佳对话）');
            $table->timestamp("firstVisitTime")->nullable()->comment('最初访问时间');
            $table->timestamp("preVisitTime")->nullable()->comment('上一次访问时间');
            $table->integer("totalVisitTime")->nullable()->comment('来访次数');
            $table->string("diaPage", 1000)->nullable()->comment('发起对话网址');
            $table->string("curFirstViewPage", 500)->nullable()->comment('本次最初访问网页');
            $table->integer("curVisitorPages")->nullable()->comment('当前访问页数');
            $table->integer("preVisitPages")->nullable()->comment('上次访问页数');
            $table->string("operatingSystem", 50)->nullable()->comment('操作系统');
            $table->string("browser", 100)->nullable()->comment('浏览器');
            $table->string("info", 1000)->nullable()->comment('对话说明');
            $table->string("siteName", 50)->nullable()->comment('当前会话所属站点名称');
            $table->integer("siteId")->nullable()->comment('当前会话所属站点ID');
            $table->json('dialogs')->nullable()->comment('本次对话的对话记录，为JSONArray [{…},{…}…]');

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
        Schema::dropIfExists('messages');
    }
}
