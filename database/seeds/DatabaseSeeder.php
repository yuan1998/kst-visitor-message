<?php

use Illuminate\Database\Seeder;
use Encore\Admin\Auth\Database\AdminTablesSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        // $this->call(MessageSeederTable::class);
        $this->call(AdminTablesSeeder::class);
    }
}
