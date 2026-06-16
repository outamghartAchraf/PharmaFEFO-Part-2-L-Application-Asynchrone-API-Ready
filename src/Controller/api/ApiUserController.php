<?php

session_start();

require_once __DIR__ . '/../../repository/UserRepository.php';
require_once __DIR__ . '/../../repository/RoleRepository.php';
require_once __DIR__ . '/../../middleware/RoleMiddleware.php';

class ApiUserController
{
    public static function login()
    {
        header('Content-Type: application/json');

        $email    = $_POST['email'] ;
        $password = $_POST['password'] ;

        if (!$email || !$password) {
            echo json_encode([
                'success' => false,
                'message' => 'All fields are required'
            ]);
            exit;
        }

        $user = UserRepository::login($email, $password);

        if (!$user) {
            echo json_encode([
                'success' => false,
                'message' => 'Invalid credentials'
            ]);
            exit;
        }

        $_SESSION['user'] = [
            'id'    => $user->id,
            'name'  => $user->name,
            'email' => $user->email,
            'role'  => $user->role
        ];

        echo json_encode([
            'success' => true,
            'message' => 'Login successful',
            'user' => $_SESSION['user']
        ]);
        exit;
    }

    public static function store()
    {
        Middleware::isAdmin();

        header('Content-Type: application/json');

        UserRepository::create(
            $_POST['name'],
            $_POST['email'],
            $_POST['password'],
            (int)$_POST['role_id']
        );

        echo json_encode([
            'success' => true,
            'message' => 'User created successfully'
        ]);
        exit;
    }

    public static function update()
    {
        Middleware::isAdmin();

        header('Content-Type: application/json');

        UserRepository::update(
            (int)$_POST['id'],
            $_POST['name'],
            $_POST['email'],
            (int)$_POST['role_id']
        );

        echo json_encode([
            'success' => true,
            'message' => 'User updated successfully'
        ]);
        exit;
    }

    public static function delete()
    {
        Middleware::isAdmin();

        header('Content-Type: application/json');

        $id = (int)($_GET['id'] ?? 0);

        UserRepository::delete($id);

        echo json_encode([
            'success' => true,
            'message' => 'User deleted successfully'
        ]);
        exit;
    }

    public static function getUsers()
    {
        Middleware::isAdmin();

        header('Content-Type: application/json');

        echo json_encode(UserRepository::getAll());
        exit;
    }

    public static function getUser()
    {
        Middleware::isAdmin();

        header('Content-Type: application/json');

        $id = (int)($_GET['id'] ?? 0);

        echo json_encode(UserRepository::getById($id));
        exit;
    }
}