<?php

namespace Modules\Auth\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use Modules\Auth\Services\AuthService;
use Modules\Auth\Utils\AuthUtil;

class AuthController extends BaseController
{
    use ResponseTrait;
    private $authService;

    public function __construct()
    {
        $this->authService = new AuthService();
    }

    public function login()
    {
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        try {
            $jwt = $this->authService->getJWT($username, $password);
            $data = ['access_token' => $jwt, 'type' => 'Bearer'];
            return $this->respondCreated($data);
        } catch (\InvalidArgumentException $e) {
            return $this->respond(['message' => 'login failed'], 401);
        }
    }

    public function getUser()
    {
        $user = AuthUtil::getUser();
        $data = ['user' => $user];
        return $this->respond($data);
    }
}