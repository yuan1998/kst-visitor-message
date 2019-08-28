<?php

use Illuminate\Database\Seeder;

class ParseMessageDialogTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Message::all()->each(function ($item) {
            var_dump('当前是'.$item->id);
            \App\Models\Dialog::generateDialogs($item->dialogs);
            $item->dialogs = null;
            $item->save();
        });
    }


}
