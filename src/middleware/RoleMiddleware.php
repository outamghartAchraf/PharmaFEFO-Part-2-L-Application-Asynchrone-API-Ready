<?php

class Middleware
{
    public static function auth(): void
    {
        

        if (!isset($_SESSION['user'])) {
            header('Location: index.php?action=login');
            exit;
        }
    }

    public static function role(array $roles): void
    {
        self::auth();

        $userRole = $_SESSION['user']['role'];

        if (!in_array($userRole, $roles)) {
            http_response_code(403);

            echo "
                <div style='font-family:Arial;padding:50px;text-align:center'>
                    <h1>403 - Access Denied</h1>
                    <p>You don't have permission to access this page.</p>
                    <a href='index.php?action=dashboard'>Back Dashboard</a>
                </div>
            ";

            exit;
        }
    }

    public static function isAdmin(): void
    {
        self::role(['ADMIN']);
    }

    public static function isPharmacien(): void
    {
        self::role(['ADMIN', 'PHARMACIEN']);
    }

    public static function isPreparateur(): void
    {
        self::role(['ADMIN', 'PHARMACIEN', 'PREPARATEUR']);
    }
}