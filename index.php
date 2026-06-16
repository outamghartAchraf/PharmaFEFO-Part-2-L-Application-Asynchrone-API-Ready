<?php

require_once __DIR__ . "/src/controller/UserController.php";
require_once __DIR__ . "/src/controller/web/MedicalController.php";
require_once __DIR__ . "/src/controller/web/BatchController.php";
require_once __DIR__ . "/src/controller/StockMovementController.php";
require_once __DIR__ . "/src/controller/NotificationController.php";
require_once __DIR__ . "/src/controller/ReportController.php";
require_once __DIR__ . "/src/controller/api/ApiMedicalController.php";
require_once __DIR__ . "/src/controller/api/ApiBatchController.php";


if (isset($_GET['action'])) {
    $action = $_GET['action'];

    switch ($action) {
        case 'login':
            UserController::loginAction();
            break;

        case 'login_submit':
            UserController::loginSubmitAction();
            break;

        // WEB
        case 'products':
            MedicalController::listAction();
            break;

        case 'products_create':
            MedicalController::createAction();
            break;

        case 'products_edit':
            MedicalController::editAction();
            break;

        case 'batches':
            BatchController::listAction();
            break;

        case 'batches_create':
            BatchController::createAction();
            break;

        case 'batches_edit':
            BatchController::editAction();
            break;



        // API
        case 'api_products':
            ApiMedicalController::index();
            break;

        case 'api_product':
            ApiMedicalController::show();
            break;

        case 'api_product_store':
            ApiMedicalController::store();
            break;

        case 'api_product_update':
            ApiMedicalController::update();
            break;

        case 'api_product_delete':
            ApiMedicalController::delete();
            break;

        case 'api_batches':
            ApiBatchController::index();
            break;

        case 'api_batch_show':
            ApiBatchController::show();
            break;

        case 'api_batch_store':
            ApiBatchController::store();
            break;

        case 'api_batch_update':
            ApiBatchController::update();
            break;

        case 'api_batch_delete':
            ApiBatchController::delete();
            break;

        case 'logout':
            UserController::logout();
            break;
    }
} else {
}
