<?php

namespace App\Admin\Controllers;

use \App\Models\FormMessage;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class FormMessageController extends Controller
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
            ->header('表单信息')
            ->description('集万千表单于一身的页面.')
            ->body($this->grid());
    }

    /**
     * Show interface.
     *
     * @param mixed $id
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
     * @param mixed $id
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
        $grid = new Grid(new FormMessage);
        $grid->model()->orderBy('id', 'desc');
        $grid->actions(function ($actions) {

            // 去掉删除
            $actions->disableDelete();

            // 去掉编辑
            $actions->disableEdit();

            // 去掉查看
//            $actions->disableView();
        });
        // 去掉批量操作
        $grid->disableCreateButton();
        $grid->disableRowSelector();


        $grid->name('姓名');
        $grid->phone('电话');
        $grid->gender('性别');
        $grid->url('表单链接');
        $grid->description('描述');
        $grid->created_at('创建时间');
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
        $show = new Show(FormMessage::findOrFail($id));

        $show->id('Id');
        $show->name('Name');
        $show->phone('Phone');
        $show->gender('Gender');
        $show->url('Url');
        $show->description('Description');
        $show->created_at('Created at');
        $show->updated_at('Updated at');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new FormMessage);

        $form->text('name', 'Name');
        $form->mobile('phone', 'Phone');
        $form->number('gender', 'Gender');
        $form->url('url', 'Url');
        $form->text('description', 'Description');

        return $form;
    }
}
