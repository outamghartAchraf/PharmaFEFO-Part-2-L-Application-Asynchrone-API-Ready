<?php

require_once __DIR__ . '/../repository/StockMovementRepository.php';
require_once __DIR__ . '/../repository/BatchRepository.php';
require_once __DIR__ . '/../repository/MedicalRepository.php';
require_once __DIR__ . "/../middleware/RoleMiddleware.php";

class StockMovementApiService
{
        public static function index()
    {
        header('Content-Type: application/json');

        $movements = StockMovementRepository::getAll();

        echo json_encode($movements);
        exit;
    }
    

    public static function store()
    {
        Middleware::isPreparateur();
        header('Content-Type: application/json');

        $productId = (int) $_POST['product_id'];
        $type      = $_POST['type'];
        $quantity  = (int) $_POST['quantity'];
        $note      = trim($_POST['note']);

        $userId    = $_SESSION['user']['id'];
        $type      = strtoupper($_POST['type']);
        $date      = date('Y-m-d H:i:s');

        if ($productId <= 0 || $quantity <= 0 || empty($type)) {
            echo json_encode([
                'success' => false,
                'message' => "Please fill all required fields."
            ]);
            exit;
        }

        $batchId = null;

        if ($type === 'OUT') {

            $batch = BatchRepository::getNextBatchFEFO($productId);

            if (!$batch) {
                echo json_encode([
                    'success' => false,
                    'message' => "No available batch for this product."
                ]);
                exit;
            }

            if ($batch->qty_available < $quantity) {
                echo json_encode([
                    'success' => false,
                    'message' => "Not enough stock in FEFO batch."
                ]);
                exit;
            }

            $batchId = $batch->id;

            $newQty = $batch->qty_available - $quantity;
            BatchRepository::updateQuantity($batchId, $newQty);
        }

        if ($type === 'IN') {

            $batch = BatchRepository::getNextBatchFEFO($productId);

            if ($batch) {
                $batchId = $batch->id;

                $newQty = $batch->qty_available + $quantity;
                BatchRepository::updateQuantity($batchId, $newQty);
            }
        }

        StockMovementRepository::create(
            $batchId,
            $userId,
            $type,
            $quantity,
            $note,
            $date
        );

        echo json_encode([
            'success' => true,
            'message' => "Stock movement saved successfully!"
        ]);

        exit;
    }
}