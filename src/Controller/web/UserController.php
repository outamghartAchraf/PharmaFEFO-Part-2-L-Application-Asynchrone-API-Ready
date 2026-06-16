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

    public static function create()
    {
        Middleware::isAdmin();

        $roles = RoleRepository::getAll();

        include __DIR__ . '/../../../views/templates/dashboard/users/create.php';
    }

    public static function edit()
    {
        Middleware::isAdmin();

        $id = (int) $_GET['id'];

        $user  = UserRepository::getById($id);
        $roles = RoleRepository::getAll();

        include __DIR__ . '/../../../views/templates/dashboard/users/edit.php';
    }

    public static function logout()
    {
        session_destroy();

        header('Location: index.php?action=login');
        exit;
    }
}