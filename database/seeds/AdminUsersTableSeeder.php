<?php

use Illuminate\Database\Seeder;

class AdminUsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('admin_users')->delete();
        
        \DB::table('admin_users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'username' => 'admin',
                'password' => '$2y$10$XvzNFD3Hw.DQ/pbgV6QlDu0vEMb3dCt3e0FOqL94nrBJ86zklCNLS',
                'name' => '六亲不认',
                'avatar' => NULL,
                'remember_token' => NULL,
                'created_at' => '2018-12-08 17:50:08',
                'updated_at' => '2018-12-08 18:03:11',
            ),
        ));
        
        
    }
}