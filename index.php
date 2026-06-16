<?php
require_once __DIR__ . "/src/controller/web/UserController.php";
require_once __DIR__ . "/src/controller/web/MedicalController.php";
require_once __DIR__ . "/src/controller/web/BatchController.php";
require_once __DIR__ . "/src/controller/web/StockMovementController.php";
require_once __DIR__ . "/src/controller/web/NotificationController.php";
require_once __DIR__ . "/src/controller/ReportController.php";
require_once __DIR__ . "/src/controller/api/ApiMedicalController.php";
require_once __DIR__ . "/src/controller/api/ApiBatchController.php";
require_once __DIR__ . "/src/controller/api/ApiUserController.php";
require_once __DIR__ . "/src/controller/web/DashboardController.php";
require_once __DIR__ . "/src/controller/api/ApiNotificationController.php";
require_once __DIR__ . "/src/controller/api/StockMovementApiController.php";



if (isset($_GET['action'])) {
    $action = $_GET['action'];

    switch ($action) {

        // WEB

        case 'login':
            UserController::login();
            break;

        case 'user_index':
            UserController::index();
            break;

        case 'user_create':
            UserController::create();
            break;

        case 'user_edit':
            UserController::edit();
            break;

        case 'dashboard':
            DashboardController::DashboardAction();
            break;

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

        case 'batch_edit':
            BatchController::editAction();
            break;

        case 'stock_movements':
            StockMovementController::index();
            break;

        case 'stock_create':
            StockMovementController::create_stock();
            break;

        case 'stock_by_batch':
            StockMovementController::byBatch();
            break;

        case 'stock_in':
            StockMovementController::in();
            break;

        case 'stock_out':
            StockMovementController::out();
            break;

        case 'notifications':
            NotificationController::index();
            break;


        // API

        case 'api_login':
            ApiUserController::login();
            break;

        case 'api_user_store':
            ApiUserController::store();
            break;

        case 'api_user_update':
            ApiUserController::update();
            break;

        case 'api_user_delete':
            ApiUserController::delete();
            break;

        case 'api_users':
            ApiUserController::getUsers();
            break;

        case 'api_user':
            ApiUserController::getUser();
            break;

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

        case 'api_stock_store':
            StockMovementApiController::store();
            break;

        case 'api_stock_movements':
            StockMovementApiController::index();
            break;

        case 'api_notifications':
            ApiNotificationController::index();
            break;
    }
} else {
}
