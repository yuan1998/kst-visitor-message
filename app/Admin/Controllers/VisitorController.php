<?php

namespace App\Admin\Controllers;

use App\Models\Message;
use App\Http\Controllers\Controller;
use Encore\Admin\Admin;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class VisitorController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content, $type = null)
    {
        $header = '访客管理';

        if ($type) {
            $str = inArrayOrNull($type, Message::$dataTypeArray, '');
            if (!$str) {
                dd('Not Page');
            }

            $header .= " - $str";
        }

        return $content
            ->header($header)
            ->description('所有访客信息')
            ->body($this->grid($type));
    }

    /**
     * Show interface.
     *
     * @param mixed   $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->header('Detail')
            ->description('description')
            ->body($this->detail($id));
    }

    /**
     * Edit interface.
     *
     * @param mixed   $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header('Edit')
            ->description('description')
            ->body($this->form()->edit($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header('Create')
            ->description('description')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid($type)
    {
        $grid = new Grid(new Message);
        $grid->model()->with('visitor')->orderBy('curEnterTime', 'desc');
        if ($type) {
            $grid->model()->where('data_type', $type);
        }
        $grid->filter(function ($filter) {
            // 去掉默认的id过滤器
            $filter->disableIdFilter();

            $filter->column(1 / 2, function ($filter) {
                $filter->equal('recId', '访客ID');
                $filter->like('visitorName', '访客名称');
                $filter->like('firstCsId', '初次接待客服');
                $filter->like('joinCsIds', '参与接待客服');
                $filter->like('keyword', '关键词');
                $filter->like('sourceProvince', '来源省市');
                $filter->like('sourceIp', '来源IP');
            });
            $filter->column(1 / 2, function ($filter) {
                $filter->like('clue', '线索');
                $filter->like('diaPage', '发起对话网址');
                $filter->group('visitorSendNum', '发送消息数', function ($group) {
                    $group->gt('大于');
                    $group->lt('小于');
                    $group->nlt('不小于');
                    $group->ngt('不大于');
                    $group->equal('等于');
                });
                $filter->group('dialogs' , '聊天记录', function ($group) {
                    $group->where('仅访客消息',function ($query) {
                        $test = $this->input;
                        $query->whereRaw('JSON_CONTAINS(dialogs, \'1\' , CONCAT(JSON_UNQUOTE(JSON_SEARCH(dialogs->"$**.recContent" , "one",?)),\'.recType\'))=1',["%{$test}%"])
                            ->whereRaw('JSON_SEARCH(dialogs->"$[*].recContent" , "one",?) IS NOT NULL' , ["%{$test}%"]);
                    });
                    $group->where('所有消息',function ($query) {
                        $test = $this->input;
                        $query->whereRaw('JSON_SEARCH(dialogs->"$[*].recContent" , "one",?) IS NOT NULL' , ["%{$test}%"]);
                    });

                });
//                $filter->like()->integer();
                $filter->equal('dialogType', '访客类型')->select(Message::$dialogTypeArray);
                $filter->between('curEnterTime', '最近一次访问')->datetime();
            });


            // 在这里添加字段过滤器

        });

        $grid->disableCreateButton();
        $grid->disableActions();


        $grid->id('Id')->style('min-width:50px;');
        $grid->data_type('所属')->style('min-width:50px;')->display(function ($val) {
            return inArrayOrNull($val, Message::$dataTypeArray);
        });
        $grid->recId('访客ID')->style('min-width:100px;');
        $grid->clue('线索')->display(function ($val) {
            $result = '-无-';
            if ($val) {
                $arr    = explode('|', $val);
                $result = implode('<br>', $arr);
            }
            return $result;
        });
        $grid->dialogs('对话记录')->style('text-align:center;')->messageModal();
        $grid->cloumn('名片')->display(function () {
            return $this->visitor ? $this->visitor : null;
        })->cardModal();
        $grid->visitorName('访客名称')->style('min-width:120px;');
        $grid->curStayTime('访客停留时间（秒 ）')->style('min-width:150px;')->display(function ($value) {
            return timeToString($value);
        });
        $grid->sourceIp('访客来源IP')->style('min-width:120px;');;
        $grid->sourceProvince('来源省市')->style('min-width:100px;');
        $grid->sourceIpInfo('访客来源IP信息（网络接入商）')->style('min-width:220px;');
        $grid->terminalType('终端类型')->style('min-width:100px;')->display(function ($value) {
            return inArrayOrNull($value, Message::$terminalTypeArray);
        });
        $grid->requestType('对话请求方式')->style('min-width:120px;')->display(function ($value) {
            return inArrayOrNull($value, Message::$requestTypeArray);
        });
        $grid->endType('对话结束方式')->style('min-width:120px;')->display(function ($value) {
            return inArrayOrNull($value, Message::$endTypeArray);
        });


        $grid->visitorSendNum('访客发送消息数')->style('min-width:140px;');
        $grid->csSendNum('客服发送消息数')->style('min-width:140px;');
        $grid->sourceType('来源类型')->style('min-width:120px;');
        $grid->searchEngine('搜索引擎')->style('min-width:80px;');
        $grid->keyword('搜索关键词')->style('min-width:120px;');
        $grid->firstCsId('初次接待客服')->style('min-width:120px;');
        $grid->joinCsIds('参与接待客服')->style('min-width:120px;');
        $grid->dialogType('对话类型')->style('min-width:120px;')->display(function ($value) {
            return inArrayOrNull($value, Message::$dialogTypeArray);
        });
        $grid->diaPage('发起对话网址')->style('min-width:120px;');
        $grid->curFirstViewPage('本次最初访问网页');
        $grid->curVisitorPages('当前访问页数');
        $grid->preVisitPages('上次访问页数');
        $grid->operatingSystem('操作系统');
        $grid->browser('浏览器');
        $grid->info('对话说明');
        $grid->siteName('当前会话所属站点名称');
        $grid->siteId('当前会话所属站点ID');

        $grid->visitorId('访客标识')->style('min-width:250px;');

        $grid->curEnterTime('最近一次访问网站时间')->style('min-width:150px;');
        $grid->firstVisitTime('最初访问时间')->style('min-width:190px;');
        $grid->preVisitTime('上一次访问时间')->style('min-width:190px;');
        $grid->diaStartTime('对话开始时间')->style('min-width:120px;');
        $grid->diaEndTime('对话结束时间')->style('min-width:120px;');
        $grid->totalVisitTime('累计来访次数')->style('min-width:120px;');
        $grid->sourceUrl('来源网页')->limit(50);
//        $grid->created_at('Created at');
//        $grid->updated_at('Updated at');


        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Message::findOrFail($id));

        $show->id('Id');
        $show->recId('RecId');
        $show->visitorId('VisitorId');
        $show->visitorName('VisitorName');
        $show->curEnterTime('CurEnterTime');
        $show->curStayTime('CurStayTime');
        $show->sourceIp('SourceIp');
        $show->sourceProvince('SourceProvince');
        $show->sourceIpInfo('SourceIpInfo');
        $show->requestType('RequestType');
        $show->endType('EndType');
        $show->diaStartTime('DiaStartTime');
        $show->diaEndTime('DiaEndTime');
        $show->terminalType('TerminalType');
        $show->visitorSendNum('VisitorSendNum');
        $show->csSendNum('客服发送消息数');
        $show->sourceUrl('SourceUrl');
        $show->sourceType('SourceType');
        $show->searchEngine('SearchEngine');
        $show->keyword('Keyword');
        $show->firstCsId('FirstCsId');
        $show->joinCsIds('参与接待客服');
        $show->dialogType('对话类型')->display(function ($value) {
            $result = '-';

            switch ($value) {
                case 'dt_v_ov':
                    $result = '仅访问网站';
                    break;
                case 'dt_v_nm':
                    $result = '访客无消息';
                    break;
                case 'dt_c_na':
                    $result = '客服未接受';
                    break;
                case 'dt_c_nm':
                    $result = '客服无消息';
                    break;
                case 'dt_d_o':
                    $result = '其他有效对话';
                    break;
                case 'dt_d_n':
                    $result = '一般对话';
                    break;
                case 'dt_d_g':
                    $result = '较好对话';
                    break;
                case 'dt_d_b':
                    $result = '更好/极佳对话';
                    break;
            }
            return $result;
        });
        $show->firstVisitTime('FirstVisitTime');
        $show->preVisitTime('上一次访问时间');
        $show->totalVisitTime('累计来访次数');
        $show->diaPage('DiaPage');
        $show->curFirstViewPage('CurFirstViewPage');
        $show->curVisitorPages('CurVisitorPages');
        $show->preVisitPages('PreVisitPages');
        $show->operatingSystem('OperatingSystem');
        $show->browser('Browser');
        $show->info('Info');
        $show->siteName('当前会话所属站点名称');
        $show->siteId('SiteId');
        $show->dialogs('Dialogs');
        $show->created_at('Created at');
        $show->updated_at('Updated at');
        $show->data_type('Data type');
        $show->clue('Clue');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Message);

        $form->number('recId', 'RecId');
        $form->text('visitorId', 'VisitorId');
        $form->text('visitorName', 'VisitorName');
        $form->datetime('curEnterTime', 'CurEnterTime')->default(date('Y-m-d H:i:s'));
        $form->number('curStayTime', 'CurStayTime');
        $form->text('sourceIp', 'SourceIp');
        $form->text('sourceProvince', 'SourceProvince');
        $form->text('sourceIpInfo', 'SourceIpInfo');
        $form->text('requestType', 'RequestType');
        $form->text('endType', 'EndType');
        $form->datetime('diaStartTime', 'DiaStartTime')->default(date('Y-m-d H:i:s'));
        $form->datetime('diaEndTime', 'DiaEndTime')->default(date('Y-m-d H:i:s'));
        $form->text('terminalType', 'TerminalType');
        $form->number('visitorSendNum', 'VisitorSendNum');
        $form->number('csSendNum', 'CsSendNum');
        $form->text('sourceUrl', 'SourceUrl');
        $form->text('sourceType', 'SourceType');
        $form->text('searchEngine', 'SearchEngine');
        $form->text('keyword', 'Keyword');
        $form->text('firstCsId', 'FirstCsId');
        $form->text('joinCsIds', 'JoinCsIds');
        $form->text('dialogType', 'DialogType');
        $form->datetime('firstVisitTime', 'FirstVisitTime')->default(date('Y-m-d H:i:s'));
        $form->datetime('preVisitTime', 'PreVisitTime')->default(date('Y-m-d H:i:s'));
        $form->number('totalVisitTime', 'TotalVisitTime');
        $form->text('diaPage', 'DiaPage');
        $form->text('curFirstViewPage', 'CurFirstViewPage');
        $form->number('curVisitorPages', 'CurVisitorPages');
        $form->number('preVisitPages', 'PreVisitPages');
        $form->text('operatingSystem', 'OperatingSystem');
        $form->text('browser', 'Browser');
        $form->text('info', 'Info');
        $form->text('siteName', 'SiteName');
        $form->number('siteId', 'SiteId');
        $form->text('dialogs', 'Dialogs');
        $form->text('data_type', 'Data type')->default('zx');
        $form->text('clue', 'Clue');

        return $form;
    }
}
