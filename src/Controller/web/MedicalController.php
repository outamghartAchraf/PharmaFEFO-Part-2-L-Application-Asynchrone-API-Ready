<?php

require_once __DIR__ . '/../../Repository/MedicalRepository.php';
require_once __DIR__ . '/../../middleware/RoleMiddleware.php';

class MedicalController
{
    public static function listAction()
    {
        Middleware::isPharmacien();

        include __DIR__ . '/../../../views/templates/dashboard/products/index.php';
    }

    public static function createAction()
    {
        Middleware::isPharmacien();

        include __DIR__ . '/../../../views/templates/dashboard/products/create.php';
    }

    public static function editAction()
    {
        Middleware::isPharmacien();

        $id = intval($_GET['id']);
        $product = MedicalRepository::getById($id);

        include __DIR__ . '/../../../views/templates/dashboard/products/edit.php';
    }
}