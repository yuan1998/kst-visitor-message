<?php

use Illuminate\Database\Seeder;

class AdminMenuTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('admin_menu')->delete();
        
        \DB::table('admin_menu')->insert(array (
            0 => 
            array (
                'id' => 1,
                'parent_id' => 0,
                'order' => 1,
                'title' => '首页',
                'icon' => 'fa-bar-chart',
                'uri' => '/',
                'permission' => NULL,
                'created_at' => NULL,
                'updated_at' => '2018-12-08 17:58:26',
            ),
            1 => 
            array (
                'id' => 2,
                'parent_id' => 0,
                'order' => 3,
                'title' => '设置',
                'icon' => 'fa-tasks',
                'uri' => NULL,
                'permission' => NULL,
                'created_at' => NULL,
                'updated_at' => '2018-12-14 09:49:07',
            ),
            2 => 
            array (
                'id' => 3,
                'parent_id' => 2,
                'order' => 4,
                'title' => '用户',
                'icon' => 'fa-users',
                'uri' => 'auth/users',
                'permission' => NULL,
                'created_at' => NULL,
                'updated_at' => '2018-12-14 09:49:07',
            ),
            3 => 
            array (
                'id' => 4,
                'parent_id' => 2,
                'order' => 5,
                'title' => '角色',
                'icon' => 'fa-user',
                'uri' => 'auth/roles',
                'permission' => NULL,
                'created_at' => NULL,
                'updated_at' => '2018-12-14 09:49:07',
            ),
            4 => 
            array (
                'id' => 5,
                'parent_id' => 2,
                'order' => 6,
                'title' => '权限',
                'icon' => 'fa-ban',
                'uri' => 'auth/permissions',
                'permission' => NULL,
                'created_at' => NULL,
                'updated_at' => '2018-12-14 09:49:07',
            ),
            5 => 
            array (
                'id' => 6,
                'parent_id' => 2,
                'order' => 7,
                'title' => '菜单',
                'icon' => 'fa-bars',
                'uri' => 'auth/menu',
                'permission' => NULL,
                'created_at' => NULL,
                'updated_at' => '2018-12-14 09:49:07',
            ),
            6 => 
            array (
                'id' => 7,
                'parent_id' => 2,
                'order' => 8,
                'title' => '操作日志',
                'icon' => 'fa-history',
                'uri' => 'auth/logs',
                'permission' => NULL,
                'created_at' => NULL,
                'updated_at' => '2018-12-14 09:49:07',
            ),
            7 => 
            array (
                'id' => 8,
                'parent_id' => 0,
                'order' => 2,
                'title' => '访客管理',
                'icon' => 'fa-bars',
                'uri' => NULL,
                'permission' => NULL,
                'created_at' => '2018-12-14 09:49:00',
                'updated_at' => '2018-12-14 16:59:12',
            ),
            8 => 
            array (
                'id' => 9,
                'parent_id' => 8,
                'order' => 0,
                'title' => '全部',
                'icon' => 'fa-bars',
                'uri' => 'visitor',
                'permission' => NULL,
                'created_at' => '2018-12-14 16:59:59',
                'updated_at' => '2018-12-14 16:59:59',
            ),
            9 => 
            array (
                'id' => 10,
                'parent_id' => 8,
                'order' => 0,
                'title' => '整形',
                'icon' => 'fa-bars',
                'uri' => 'visitor/zx',
                'permission' => NULL,
                'created_at' => '2018-12-14 17:00:26',
                'updated_at' => '2018-12-14 17:00:26',
            ),
            10 => 
            array (
                'id' => 11,
                'parent_id' => 8,
                'order' => 0,
                'title' => '口腔',
                'icon' => 'fa-bars',
                'uri' => 'visitor/kq',
                'permission' => NULL,
                'created_at' => '2018-12-14 17:00:44',
                'updated_at' => '2018-12-14 17:00:44',
            ),
        ));
        
        
    }
}