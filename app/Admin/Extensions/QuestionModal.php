<?php

namespace App\Admin\Extensions;

use Encore\Admin\Grid\Displayers\AbstractDisplayer;

class QuestionModal extends AbstractDisplayer
{
    public function display()
    {
        $data = json_decode($this->value, true);

        if (empty($data)) {
            return '-无-';
        }
        $id = "yuan-" . uniqid() . '-' . mt_rand(1000, 9999);

        $value = collect($data)->map(function ($item) {
            return $this->generationQuestion($item);
        })->implode("");

        return <<<EOT
<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#$id">
  查看问卷
</button>
<div class="modal fade question-modal" id="$id" tabindex="-1" role="dialog" aria-labelledby="#$id" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">问卷</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-container">
                    $value
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

    function generationQuestion($item)
    {
        $str = $this->generationQuestionItems($item);


        return <<<EOT
<div class="card-item">
    <div class="question-header-title">
        {$item['title']}
    </div>
    <div class="question-content">
        $str
    </div>
    
</div> 
EOT;
    }

    function generationQuestionItems($item)
    {
        return collect($item['questions'])->map(function ($question,$index) {
            $selected = $question['selected'];

            $str = $this->generationQuestionAsk($question['ask'], $selected);
            $order= $index + 1;
            return <<<EOT
<div class="question-item-content">
    <div class="question-title">
       {$order}. {$question['question']}    
    </div>
    $str
</div>
EOT;
        })->implode("");
    }

    function generationQuestionAsk($ask, $selected)
    {
        $str = collect($ask)->map(function ($ask) use ($selected) {
            $cal = $selected === $ask['type'] ? 'yuan-question-select' : '';

            return <<<EOT
<div class="ask-item $cal">
  {$ask['type']}. {$ask['text']} 
</div>
EOT;
        })->implode("");


        return <<<EOT
<div class="ask-items">
    $str
</div>
EOT;

    }
}
