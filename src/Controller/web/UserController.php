<?php

require_once __DIR__ . '/../../repository/UserRepository.php';
require_once __DIR__ . '/../../repository/RoleRepository.php';
require_once __DIR__ . '/../../middleware/RoleMiddleware.php';

class UserController
{
    public static function login()
    {
        require_once __DIR__ . '/../../../views/auth/login.php';
    }

    public static function index()
    {
        Middleware::isAdmin();

        $users = UserRepository::getAll();

        include __DIR__ . '/../../../views/templates/dashboard/users/index.php';
    }


}