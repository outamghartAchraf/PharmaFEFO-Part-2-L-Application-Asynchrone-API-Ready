<?php

require_once __DIR__ . '/../../repository/StockMovementRepository.php';
require_once __DIR__ . '/../../repository/BatchRepository.php';
require_once __DIR__ . '/../../repository/MedicalRepository.php';
require_once __DIR__ . "/../../middleware/RoleMiddleware.php";

class StockMovementController
{
    public static function index()
    {
        Middleware::isPreparateur();
        $movements = StockMovementRepository::getAll();

        include __DIR__ . "/../../../views/templates/dashboard/stock_movements/index.php";
         
    }

    public static function create_stock()
    {
        Middleware::isPreparateur();
        $products = MedicalRepository::getAll();

        include __DIR__ . "/../../../views/templates/dashboard/stock_movements/create.php";
    }

    public static function byBatch()
    {
        Middleware::isPreparateur();
        $batchId = (int) $_GET['batch_id'];

        $movements = StockMovementRepository::findByBatchId($batchId);

        include __DIR__ . "/../../../views/templates/dashboard/stock_movements/index.php";
    }

    public static function out()
    {
        Middleware::isPreparateur();
        $movements = StockMovementRepository::findByType('OUT');

        include __DIR__ . "/../../../views/templates/dashboard/stock_movements/index.php";
    }

    public static function in()
    {
        Middleware::isPreparateur();
        $movements = StockMovementRepository::findByType('IN');

        include __DIR__ . "/../../../views/templates/dashboard/stock_movements/index.php";
    }
}