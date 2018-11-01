<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\User::class,20)->create();
        $user=\App\User::find('1');
        $user['name']='秒速五厘米';
        $user['is_admin']=true;
        $user['email']='730308009@qq.com';
        $user['password']=bcrypt('admin888');
        $user->save();
    }
}
