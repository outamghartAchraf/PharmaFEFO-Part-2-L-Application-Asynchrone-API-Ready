<?php

require_once __DIR__ . '/../../Repository/ReportRepository.php';
require_once __DIR__ . "/../../middleware/RoleMiddleware.php";

class ApiReportController
{
    public static function statistics()
    {
        Middleware::isPharmacien();

        header('Content-Type: application/json');

        echo json_encode(
            ReportRepository::getStatistics()
        );

        exit;
    }

    public static function stock()
    {
        Middleware::isPharmacien();

        header('Content-Type: application/json');

        echo json_encode(
            ReportRepository::getCurrentStockReport()
        );

        exit;
    }

    public static function expired()
    {
        Middleware::isPharmacien();

        header('Content-Type: application/json');

        echo json_encode(
            ReportRepository::getExpiredReport()
        );

        exit;
    }

    public static function expiringSoon()
    {
        Middleware::isPharmacien();

        header('Content-Type: application/json');

        echo json_encode(
            ReportRepository::getExpiringSoonReport()
        );

        exit;
    }

    public static function movements()
    {
        Middleware::isPharmacien();

        header('Content-Type: application/json');

        echo json_encode(
            ReportRepository::getMovementsReport()
        );

        exit;
    }
}