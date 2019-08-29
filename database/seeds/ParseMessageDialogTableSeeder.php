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
        $maxCount = \App\Models\Message::count();
        $count = ceil($maxCount/100);


        for ($i = 0;$i < $count;$i++) {
            $items = \App\Models\Message::query()->skip($i* 100)->take(100)->get();

            $items->each(function ($item) use ($maxCount) {

                var_dump('当前是:'. $item->id . ',总数是:'.$maxCount);
                if ($item->dialogs) {
                    \App\Models\Dialog::generateDialogs($item->dialogs);
                    $item->dialogs = null;
                    $item->save();
                }
            });
        }
    }
}
