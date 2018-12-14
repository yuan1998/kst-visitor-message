<?php

namespace App\Admin\Extensions;

use Encore\Admin\Grid\Displayers\AbstractDisplayer;

class CardModal extends AbstractDisplayer
{
    public function display()
    {
        if (empty($this->value)) {
            return '-无-';
        }
        $data = valueOfDefault($this->value , '-NULL-');
        $id = "yuan-" . $data['id'];

        return <<<EOT
<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#$id">
  查看名片
</button>
<div class="modal fade" id="$id" tabindex="-1" role="dialog" aria-labelledby="#$id" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">名片</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-container">
                    <div class="card-item">
                        <div class="card-label">ID</div>
                        <div class="card-text">{$data['id']}</div>
                    </div>
                    <div class="card-item">
                        <div class="card-label">联系人名称</div>
                        <div class="card-text">{$data['linkman']}</div>
                    </div>
                    <div class="card-item">
                        <div class="card-label">访客类型</div>
                        <div class="card-text">{$data['cusType']}</div>
                    </div>
                    <div class="card-item">
                        <div class="card-label">公司名称</div>
                        <div class="card-text">{$data['compName']}</div>
                    </div>
                    <div class="card-item">
                        <div class="card-label">网址</div>
                        <div class="card-text">{$data['webUrl']}</div>
                    </div>
                    <div class="card-item">
                        <div class="card-label">手机</div>
                        <div class="card-text">{$data['mobile']}</div>
                    </div>
                    <div class="card-item">
                        <div class="card-label">电话</div>
                        <div class="card-text">{$data['phone']}</div>
                    </div>
                    <div class="card-item">
                        <div class="card-label">QQ</div>
                        <div class="card-text">{$data['qq']}</div>
                    </div>
                    <div class="card-item">
                        <div class="card-label">MSN/微信</div>
                        <div class="card-text">{$data['msn']}</div>
                    </div>
                    <div class="card-item">
                        <div class="card-label">邮箱</div>
                        <div class="card-text">{$data['email']}</div>
                    </div>
                    <div class="card-item">
                        <div class="card-label">地址</div>
                        <div class="card-text">{$data['address']}</div>
                    </div>
                    <div class="card-item">
                        <div class="card-label">生日</div>
                        <div class="card-text">{$data['birthday']}</div>
                    </div>
                    <div class="card-item">
                        <div class="card-label">备注</div>
                        <div class="card-text">{$data['remark']}</div>
                    </div>
                    <div class="card-item">
                        <div class="card-label">所属客服（登录名）</div>
                        <div class="card-text">{$data['loginName']}</div>
                    </div>
                    <div class="card-item">
                        <div class="card-label">所属客服（姓名）</div>
                        <div class="card-text">{$data['userName']}</div>
                    </div>
                    <div class="card-item">
                        <div class="card-label">所属客服（昵称）</div>
                        <div class="card-text">{$data['nickName']}</div>
                    </div>
                    <div class="card-item">
                        <div class="card-label">添加时间</div>
                        <div class="card-text">{$data['addtime']}</div>
                    </div>
                    <div class="card-item">
                        <div class="card-label">最后修改时间</div>
                        <div class="card-text">{$data['lastChangeTime']}</div>
                    </div>
                    <div class="card-item">
                        <div class="card-label">自定义字段1</div>
                        <div class="card-text">{$data['col1']}</div>
                    </div>
                    <div class="card-item">
                        <div class="card-label">自定义字段2</div>
                        <div class="card-text">{$data['col2']}</div>
                    </div>
                    <div class="card-item">
                        <div class="card-label">自定义字段3</div>
                        <div class="card-text">{$data['col3']}</div>
                    </div>
                    <div class="card-item">
                        <div class="card-label">自定义字段4</div>
                        <div class="card-text">{$data['col4']}</div>
                    </div>
                    <div class="card-item">
                        <div class="card-label">自定义字段5</div>
                        <div class="card-text">{$data['col5']}</div>
                    </div>
                    <div class="card-item">
                        <div class="card-label">自定义字段6</div>
                        <div class="card-text">{$data['col6']}</div>
                    </div>
                    <div class="card-item">
                        <div class="card-label">自定义字段7</div>
                        <div class="card-text">{$data['col7']}</div>
                    </div>
                    <div class="card-item">
                        <div class="card-label">自定义字段8</div>
                        <div class="card-text">{$data['col8']}</div>
                    </div>
                    <div class="card-item">
                        <div class="card-label">自定义字段9</div>
                        <div class="card-text">{$data['col9']}</div>
                    </div>
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
}
