<?php

namespace Modules\Auth\Services;

use Exception;
use Modules\Auth\Utils\JWTUtil;
use Modules\User\Models\UserModel;

class AuthService
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function getJWT($username, $password)
    {
        $validatedUser = $this->validateUser($username, $password);
        if (!$validatedUser) {
            throw new Exception('user is not valid');
        }
        $jwt = JWTUtil::generate($username);
        return $jwt;
    }

    private function validateUser($username, $password)
    {
        $user = $this->userModel->where('username', $username)->first();
        if (!$user) {
            return false;
        }
        $isVerifiedPassword = password_verify($password, $user['password']);
        return $isVerifiedPassword;
    }
}