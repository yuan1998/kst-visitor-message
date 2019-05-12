<?php

namespace App\Admin\Extensions;

use App\Http\Controllers\Api\CusTypeController;
use App\Models\Message;
use Encore\Admin\Grid\Exporters\AbstractExporter;
use Maatwebsite\Excel\Facades\Excel;

class ExcelExpoter extends AbstractExporter
{

    public static $fields = [
        'id'               => 'ID',
        'visitorId'        => '访客ID',
        'recId'            => '访客标识',
        'clue'             => '线索',
        'visitorName'      => '访客名称',
        'cusType'          => '客户类型',
        'curStayTime'      => '访客停留时间（秒)',
        'sourceIp'         => '访客来源IP',
        'sourceProvince'   => '来源省市',
        'dialogs'          => '对话记录',
        'sourceIpInfo'     => '访客来源IP信息（网络接入商)',
        'terminalType'     => '终端类型',
        'requestType'      => '对话请求方式',
        'endType'          => '对话结束方式',
        'visitorSendNum'   => '访客发送消息数',
        'csSendNum'        => '客服发送消息数',
        'sourceType'       => '来源类型',
        'searchEngine'     => '搜索引擎',
        'keyword'          => '搜索关键词',
        'firstCsId'        => '初次接待客服',
        'joinCsIds'        => '参与接待客服',
        'dialogType'       => '对话类型',
        'diaPage'          => '发起对话网址',
        'curFirstViewPage' => '本次最初访问网页',
        'curVisitorPages'  => '当前访问页数',
        'preVisitPages'    => '上次访问页数',
        'operatingSystem'  => '操作系统',
        'browser'          => '浏览器',
        'info'             => '对话说明',
        'siteName'         => '当前会话所属站点名称',
        'siteId'           => '当前会话所属站点ID',
        'curEnterTime'     => '最近一次访问网站时间',
        'firstVisitTime'   => '最初访问时间',
        'preVisitTime'     => '上一次访问时间',
        'diaStartTime'     => '对话开始时间',
        'diaEndTime'       => '对话结束时间',
        'totalVisitTime'   => '累计来访次数',
        'sourceUrl'        => '来源网页',
    ];

    public function export()
    {
        Excel::create('Filename', function ($excel) {
            // Set the title
            $excel->setTitle('Our new awesome title');

            // Chain the setters
            $excel->setCreator('Maatwebsite')
                ->setCompany('Maatwebsite');

            // Call them separately
            $excel->setDescription('A demonstration to change the file properties');
            $arr = collect(ExcelExpoter::$fields);

            $excel->sheet('Sheetname', function ($sheet) use ($arr) {
                // 这段逻辑是从表格数据中取出需要导出的字段

                $sheet->rows([$arr->values()->all()]);
                $rows = collect($this->getData())->map(function ($item) use ($arr) {
                    $type            = $item['data_type'];
                    $item['dialogs'] = ExcelExpoter::dialogs($item['dialogs']);
                    $item['type']    = inArrayOrNull($type, Message::$dataTypeArray);

                    $item['clue'] = ExcelExpoter::clue($item['clue']);

                    $cusType              = $item['visitor'] ? $item['visitor']['cusType'] : null;
                    $item['cusType']      = $cusType ? CusTypeController::cusTypeData($type, $cusType) : '-无-';
                    $item['curStayTime']  = timeToString($item['curStayTime']);
                    $item['terminalType'] = inArrayOrNull($item['terminalType'], Message::$terminalTypeArray);
                    $item['requestType']  = inArrayOrNull($item['requestType'], Message::$requestTypeArray);
                    $item['endType']      = inArrayOrNull($item['endType'], Message::$endTypeArray);
                    $item['dialogType']   = inArrayOrNull($item['dialogType'], Message::$dialogTypeArray);

                    return $arr->map(function ($value , $key) use($item) {
                        return $item[$key];
                    })->all();
                    return $arr->all();
                });
                $sheet->rows($rows);
            });
        })->export('xlsx');
    }

    public static function dialogs($arr)
    {
        $result = collect($arr)->reverse()->filter(function ($item) {
            return in_array($item['recType'], [1, 2]);
        })->map(function ($item) {
            $content = preg_replace('/<[^>]+>/', '', $item['recContent']);
            return "{$item['sender']} : $content";
        });

        return $result->implode(" \r\n ");
    }

    public static function clue($val)
    {
        $result = '-无-';
        if ($val) {
            $arr    = explode('|', $val);
            $result = implode('<br>', $arr);
        }
        return $result;
    }
}
