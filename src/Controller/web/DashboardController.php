<?php
require_once __DIR__ . '/../../Repository/BatchRepository.php';
require_once __DIR__ . '/../../Repository/MedicalRepository.php';
require_once __DIR__ . '/../../Repository/StockMovementRepository.php';


class DashboardController
{
    public static function DashboardAction()
    {
    $expiredBatches = BatchRepository::getExpiredBatches();
    $expiringBatches = BatchRepository::getExpiringBatches(90);

    $expiredCount = count($expiredBatches);
    $expiringCount = count($expiringBatches);

    $totalNotifications = $expiredCount + $expiringCount;

    
    $totalProducts = count(MedicalRepository::getAll());
    $totalBatches  = count(BatchRepository::getAll());
    $totalMovements = count(StockMovementRepository::getAll());
    $fefoWarnings = BatchRepository::getFEFOWarnings();

    include __DIR__ . '/../../../views/templates/dashboard/index.php';
    }
}