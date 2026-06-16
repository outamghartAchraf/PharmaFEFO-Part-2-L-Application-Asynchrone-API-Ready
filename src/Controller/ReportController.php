<?php

require_once __DIR__ . '/../Repository/ReportRepository.php';
require_once __DIR__ . "/../middleware/RoleMiddleware.php";

class ReportController
{
 
    public static function index()
    {
        Middleware::isPharmacien();   
        $statistics = ReportRepository::getStatistics();

        include __DIR__ . '/../../views/templates/dashboard/reports/index.php';
    }
 
    public static function stock()
    {
        Middleware::isPharmacien();
        $reports = ReportRepository::getCurrentStockReport();

        include __DIR__ . '/../../views/templates/dashboard/reports/stock.php';
    }

 
    public static function expired()
    {
        Middleware::isPharmacien(); 
        $reports = ReportRepository::getExpiredReport();

        include __DIR__ . '/../../views/templates/dashboard/reports/expired.php';
    }

 
    public static function expiringSoon()
    {
        Middleware::isPharmacien();
        $reports = ReportRepository::getExpiringSoonReport();

        include __DIR__ . '/../../views/templates/dashboard/reports/expiring.php';
    }

 
    public static function movements()
    {
        Middleware::isPharmacien();
        $reports = ReportRepository::getMovementsReport();

        include __DIR__ . '/../../views/templates/dashboard/reports/movements.php';
    }
}