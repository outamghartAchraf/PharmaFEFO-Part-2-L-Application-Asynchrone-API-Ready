<?php

require_once __DIR__ . '/../Repository/BatchRepository.php';
require_once __DIR__ . '/../middleware/RoleMiddleware.php';

class ApiBatchService
{
    public static function index()
    {
        Middleware::isPharmacien();

        header('Content-Type: application/json');

        echo json_encode(
            BatchRepository::getAll()
        );
    }

    public static function show()
    {
        Middleware::isPharmacien();

        header('Content-Type: application/json');

        $id = $_GET['id'];

        echo json_encode(
            BatchRepository::getById($id)
        );
    }

    public static function store()
    {
        Middleware::isPharmacien();

        header('Content-Type: application/json');

        $productId      = $_POST['product_id'] ?? null;
        $quantity       = $_POST['quantity'] ?? null;
        $expirationDate = $_POST['expiration_date'] ?? null;
        $batchNumber    = trim($_POST['batch_number'] ?? '');

        if (
            empty($productId) ||
            empty($quantity) ||
            empty($expirationDate) ||
            empty($batchNumber)
        ) {
            http_response_code(422);

            echo json_encode([
                'success' => false,
                'message' => 'Please fill all fields correctly.'
            ]);

            return;
        }

        if ($expirationDate < date('Y-m-d')) {

            http_response_code(422);

            echo json_encode([
                'success' => false,
                'message' => 'Expiration date cannot be in the past.'
            ]);

            return;
        }

        BatchRepository::create(
            $productId,
            $batchNumber,
            $expirationDate,
            $quantity
        );

        http_response_code(201);

        echo json_encode([
            'success' => true,
            'message' => 'Batch created successfully'
        ]);
    }

    public static function update()
    {
        Middleware::isPharmacien();

        header('Content-Type: application/json');

        BatchRepository::update(
            $_POST['id'],
            $_POST['product_id'],
            $_POST['batch_number'],
            $_POST['expiration_date'],
            $_POST['qty_received'],
            $_POST['qty_available'],
            $_POST['status']
        );

        echo json_encode([
            'success' => true,
            'message' => 'Batch updated successfully'
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

            return;
        }

        BatchRepository::delete($id);

        echo json_encode([
            'success' => true,
            'message' => 'Batch deleted successfully'
        ]);
    }
}