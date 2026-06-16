<?php

require_once __DIR__ . '/../../Repository/ReportRepository.php';
require_once __DIR__ . "/../../middleware/RoleMiddleware.php";

class ReportController
{
    public static function index()
    {
        Middleware::isPharmacien();
        

        include __DIR__ . '/../../../views/templates/dashboard/reports/index.php';
    }

    public static function stock()
    {
        Middleware::isPharmacien();

        include __DIR__ . '/../../../views/templates/dashboard/reports/stock.php';
    }

    public static function expired()
    {
        Middleware::isPharmacien();

        include __DIR__ . '/../../../views/templates/dashboard/reports/expired.php';
    }

    public static function expiringSoon()
    {
        Middleware::isPharmacien();

        include __DIR__ . '/../../../views/templates/dashboard/reports/expiring.php';
    }

    public static function movements()
    {
        Middleware::isPharmacien();

        include __DIR__ . '/../../../views/templates/dashboard/reports/movements.php';
    }
}