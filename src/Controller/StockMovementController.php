<?php

require_once __DIR__ . '/../Repository/StockMovementRepository.php';
require_once __DIR__ . '/../Repository/BatchRepository.php';
require_once __DIR__ . '/../Repository/MedicalRepository.php';
 require_once __DIR__ . "/../middleware/RoleMiddleware.php";

class StockMovementController
{

    public static function index()
    {
        Middleware::isPreparateur();
        $movements = StockMovementRepository::getAll();

        include __DIR__ . "/../../views/templates/dashboard/stock_movements/index.php";
    }

    public static function create_stock()
    {
        Middleware::isPreparateur();
        $products = MedicalRepository::getAll();
        include __DIR__ . "/../../views/templates/dashboard/stock_movements/create.php";
    }

    public static function store()
    {
        Middleware::isPreparateur();
        $productId = (int) $_POST['product_id'];
        $type      = $_POST['type'];
        $quantity  = (int) $_POST['quantity'];
        $note      = trim($_POST['note'] ); 
        
        $userId    = $_SESSION['user']['id'];
        $type = strtoupper($_POST['type']);
        $date      = date('Y-m-d H:i:s');

        if ($productId <= 0 || $quantity <= 0 || empty($type)) {
            $_SESSION['error'] = "Please fill all required fields.";
            header("Location: index.php?action=stock_create");
            exit;
        }

        $batchId = null;

        if ($type === 'OUT') {

            $batch = BatchRepository::getNextBatchFEFO($productId);

            if (!$batch) {
                $_SESSION['error'] = "No available batch for this product.";
                header("Location: index.php?action=stock_create");
                exit;
            }

            if ($batch->qty_available < $quantity) {
                $_SESSION['error'] = "Not enough stock in FEFO batch.";
                header("Location: index.php?action=stock_create");
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

        $_SESSION['success'] = "Stock movement saved successfully!";
        header("Location: index.php?action=stock_movements?message=" . urlencode('Stock movement saved successfully!'));
        exit;
    }

    public static function byBatch()
    {
        Middleware::isPreparateur();
        $batchId = (int) $_GET['batch_id'];

        $movements = StockMovementRepository::findByBatchId($batchId);

        include __DIR__ . "/../../views/templates/dashboard/stock_movements/index.php";
    }

    public static function out()
    {
        Middleware::isPreparateur();
        $movements = StockMovementRepository::findByType('OUT');

        include __DIR__ . "/../../views/templates/dashboard/stock_movements/index.php";
    }

    public static function in()
    {
        Middleware::isPreparateur();
        $movements = StockMovementRepository::findByType('IN');

        include __DIR__ . "/../../views/templates/dashboard/stock_movements/index.php";
    }
}


 

