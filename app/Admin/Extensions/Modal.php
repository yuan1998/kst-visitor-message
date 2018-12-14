<?php

namespace App\Admin\Extensions;

use Encore\Admin\Admin;
use Encore\Admin\Grid\Displayers\AbstractDisplayer;

class Modal extends AbstractDisplayer
{
    public function display()
    {
        if (empty($this->value)) {
            return '-无-';
        }
        $id = "yuan-" . str_random(32);
        $body = $this->createBody($this->value);

        return <<<EOT
<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#$id">
  查看聊天记录
</button>
<div class="modal fade" id="$id" tabindex="-1" role="dialog" aria-labelledby="#$id" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">聊天记录</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="message-container">
                $body
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

EOT;

    }

    public function createBody($arr)
    {
//        dd($arr);
        $arr = array_reverse($arr);
        $str = '';

        foreach ($arr as $item) {
            if( $item['recType'] === 1) {
                $str .= "<div class='message-pop-wrap message-right'><div class='message-pop-name'>{$item['sender']}</div><div class='message-pop'><p class='message-text'>{$item['recContent']}</p></div></div>";
            }
            else if ($item['recType'] === 2) {
                $str .= "<div class='message-pop-wrap message-left'><div class='message-pop-name'>{$item['sender']}</div><div class='message-pop'><p class='message-text'>{$item['recContent']}</p></div></div>";
            }
        }

        return $str;
    }
}
