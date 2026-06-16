<?php

require_once __DIR__ . '/../../Repository/BatchRepository.php';
require_once __DIR__ . "/../../middleware/RoleMiddleware.php";
 

class ApiNotificationController
{
    public static function index()
    {
        Middleware::isPharmacien();

        header('Content-Type: application/json');

        $expiredBatches = BatchRepository::getExpiredBatches();
        $expiringBatches = BatchRepository::getExpiringBatches(90);

        echo json_encode([
            'success' => true,
            'expired_batches' => $expiredBatches,
            'expiring_batches' => $expiringBatches
        ]);

        exit;
    }
}