<?php
session_start();

/*
|--------------------------------------------------------------------------
| Load ENV (PHẢI ĐỨNG ĐẦU)
|--------------------------------------------------------------------------
*/
require_once dirname(__DIR__) . '/config/env.php';

/*
|--------------------------------------------------------------------------
| Load Database class
|--------------------------------------------------------------------------
*/
require_once dirname(__DIR__) . '/config/Database.php';

/*
|--------------------------------------------------------------------------
| Create DB connection (SAU KHI REQUIRE)
|--------------------------------------------------------------------------
*/
$db = Database::connect();

/*
|--------------------------------------------------------------------------
| Middleware
|--------------------------------------------------------------------------
*/
require_once dirname(__DIR__) . '/app/middleware/auth.php';

/*
|--------------------------------------------------------------------------
| Controllers
|--------------------------------------------------------------------------
*/
require_once dirname(__DIR__) . '/app/controllers/AuthController.php';
require_once dirname(__DIR__) . '/app/controllers/HomeController.php';
require_once dirname(__DIR__) . '/app/controllers/ReservationController.php';

require_once dirname(__DIR__) . '/app/controllers/AdminUserController.php';
require_once dirname(__DIR__) . '/app/controllers/AdminCategoryController.php';
require_once dirname(__DIR__) . '/app/controllers/ProductController.php';
require_once dirname(__DIR__) . '/app/controllers/CartController.php';
require_once dirname(__DIR__) . '/app/controllers/AdminRevenueController.php';
require_once dirname(__DIR__) . '/app/controllers/PageController.php';
require_once dirname(__DIR__) . '/app/controllers/UserController.php';
require_once dirname(__DIR__) . '/app/controllers/OrderController.php';
require_once dirname(__DIR__) . '/app/controllers/AdminProductController.php';
require_once dirname(__DIR__) . '/app/controllers/AdminReservationController.php';
require_once dirname(__DIR__) . '/app/controllers/AdminStaffController.php';
require_once dirname(__DIR__) . '/app/controllers/StaffController.php';
