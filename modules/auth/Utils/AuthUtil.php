<?php

namespace Modules\Auth\Utils;

use Modules\User\Models\UserModel;

class AuthUtil
{
    public static $user;

    public static function setUser($username)
    {
        $userModel = new UserModel();
        $user = $userModel->where('username', $username)->first();
        unset($user['password']);
        self::$user = $user;
    }

}