<?php

namespace Modules\Auth\Utils;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTUtil
{
    public static function generate($username)
    {
        $key = getenv('JWT_SECRET_KEY');
        $expired = time() + 24 * 60 * 60;
        $payload = [
            'username' => $username,
            'exp' => $expired,
        ];
        $jwt = JWT::encode($payload, $key, 'HS256');
        return $jwt;
    }

    public static function decode($jwt)
    {
        $key = getenv('JWT_SECRET_KEY');
        $decoded = JWT::decode($jwt, new Key($key, 'HS256'));
        return $decoded;
    }
}