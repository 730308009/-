<?php
/**
 * Created by PhpStorm.
 * User: miaosuwulimi
 * Date: 18-10-30
 * Time: 上午11:21
 */

namespace App\Observers;


use App\User;

class UserObserver
{
//    在数据库写入数据之前插入email——token字段
    public function creating(User $user){
        $user->email_token = str_random(10);
    }

}
