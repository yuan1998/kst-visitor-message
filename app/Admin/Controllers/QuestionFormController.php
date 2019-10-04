<?php

namespace App\Admin\Controllers;

use App\Models\QuestionForm;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class QuestionFormController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('问卷管理')
            ->description('集问卷于一身')
            ->body($this->grid());
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
    protected function grid()
    {
        $grid = new Grid(new QuestionForm);
        $grid->model()->orderBy('id', 'desc');
        $grid->expandFilter();

        $grid->filter(function ($filter) {

            // 去掉默认的id过滤器
            $filter->disableIdFilter();

            // 在这里添加字段过滤器
            $filter->equal('phone', '电话号码');

        });

        if (!Admin::user()->isRole('administrator')) {
            $grid->actions(function ($actions) {

                // 去掉删除
                $actions->disableDelete();

                // 去掉编辑
                $actions->disableEdit();

                // 去掉查看
//            $actions->disableView();
            });

            // 去掉批量操作
            $grid->disableRowSelector();
        }

        $grid->disableCreateButton();


        // $grid->id('ID')->style('text-align:center')->defaultNull();
        $grid->questions('问卷')->questionModal();
        $grid->name('姓名')->style('text-align:center')->defaultNull();
        $grid->phone('电话')->style('text-align:center')->defaultNull();
//        $grid->gender('性别')->style('text-align:center')->defaultNull();
        $grid->od_fraction('OD 分数')->style('text-align:center')->defaultNull();
        $grid->sr_fraction('SR 分数')->style('text-align:center')->defaultNull();
        $grid->pn_fraction('PN 分数')->style('text-align:center')->defaultNull();
        $grid->wt_fraction('WT 分数')->style('text-align:center')->defaultNull();
        $grid->created_at('创建日期')->style('text-align:center')->defaultNull();

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
        $show = new Show(QuestionForm::findOrFail($id));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new QuestionForm);


        return $form;
    }
}
