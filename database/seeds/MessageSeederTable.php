<?php

use Illuminate\Database\Seeder;

class MessageSeederTable extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Message::insert($this->messages);
    }
}
