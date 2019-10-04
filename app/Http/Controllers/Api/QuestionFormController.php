<?php

namespace App\Http\Controllers\Api;

use App\Models\QuestionForm;
use Illuminate\Http\Request;

class QuestionFormController extends Controller
{

    public function store(Request $request)
    {
        $data = $request->only([
            'name',
            'phone',
            'gender',
            'od_fraction',
            'sr_fraction',
            'pn_fraction',
            'wt_fraction',
            'questions',
        ]);

        $res = QuestionForm::create($data);

        return $this->response->array($res);
    }


    public function getResult(Request $request)
    {
        $id = $request->get('id');

        if (!$id || !$question = QuestionForm::find($id, [
                'name', 'phone', 'gender', 'od_fraction', 'sr_fraction', 'pn_fraction', 'wt_fraction'
            ])
        ) {
            $this->response->errorBadRequest();
            return;
        }

        return $this->response->array($question);

    }
}
