<?php

require_once __DIR__ . '/../../Repository/BatchRepository.php';
require_once __DIR__ . '/../../Repository/MedicalRepository.php';
require_once __DIR__ . '/../../middleware/RoleMiddleware.php';

class BatchController
{
    public static function listAction()
    {
        Middleware::isPharmacien();

        include __DIR__ . '/../../../views/templates/dashboard/batches/index.php';
    }

    public static function createAction()
    {
        Middleware::isPharmacien();

        $products = MedicalRepository::getAll();

        include __DIR__ . '/../../../views/templates/dashboard/batches/create.php';
    }

    public static function editAction()
    {
        Middleware::isPharmacien();

        $id = intval($_GET['id']);

        $batch = BatchRepository::getById($id);

        $products = MedicalRepository::getAll();

        include __DIR__ . '/../../../views/templates/dashboard/batches/edit.php';
    }
}