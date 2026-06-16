<?php

require_once __DIR__ . '/../../Repository/MedicalRepository.php';
require_once __DIR__ . '/../../middleware/RoleMiddleware.php';

class ApiMedicalController
{
    public static function index()
    {
        Middleware::isPharmacien();

        header('Content-Type: application/json');

        echo json_encode(
            MedicalRepository::getAll()
            
        );
    }

    public static function show()
    {
        Middleware::isPharmacien();

        header('Content-Type: application/json');

        $id = $_GET['id'];

        echo json_encode(
            MedicalRepository::getById($id)
        );
    }

public static function store()
{
    Middleware::isPharmacien();

    header('Content-Type: application/json');

    $cipCode = trim($_POST['cip_code'] );
    $designation = trim($_POST['designation'] ?? '');
    $price = floatval($_POST['price'] ?? 0);
    $minStockAlert = intval($_POST['min_stock_alert'] ?? 0);

    if (
        empty($cipCode) ||
        empty($designation) ||
        $price <= 0 ||
        $minStockAlert < 0
    ) {
        http_response_code(422);

        echo json_encode([
            'success' => false,
            'message' => 'Please fill all fields correctly.'
        ]);

        return;
    }

    MedicalRepository::create(
        $cipCode,
        $designation,
        $price,
        $minStockAlert
    );

    http_response_code(201);

    echo json_encode([
        'success' => true,
        'message' => 'Product created successfully'
    ]);
}

    public static function update()
    {
        Middleware::isPharmacien();

        header('Content-Type: application/json');

        MedicalRepository::update(
            $_POST['id'],
            $_POST['cip_code'],
            $_POST['designation'],
            floatval($_POST['price']),
            intval($_POST['min_stock_alert'])
        );

        echo json_encode([
            'success' => true,
            'message' => 'Product updated successfully'
        ]);
    }

public static function delete()
{
    Middleware::isPharmacien();

    header('Content-Type: application/json');

    $id = $_GET['id'] ?? null;

    if (!$id) {
        echo json_encode([
            'success' => false,
            'message' => 'ID is required'
        ]);
        exit;
    }

    MedicalRepository::delete($id);

    echo json_encode([
        'success' => true,
        'message' => 'Product deleted successfully'
    ]);
    exit;
}
}