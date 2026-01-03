<?php
session_start();

/*
|--------------------------------------------------------------------------
| Database
|--------------------------------------------------------------------------
*/
require_once __DIR__ . '/../config/database.php';

/*
|--------------------------------------------------------------------------
| Middleware
|--------------------------------------------------------------------------
*/
require_once __DIR__ . '/../app/middleware/auth.php';

/*
|--------------------------------------------------------------------------
| Controllers - Auth & Home
|--------------------------------------------------------------------------
*/
require_once __DIR__ . '/../app/controllers/AuthController.php';
require_once __DIR__ . '/../app/controllers/HomeController.php';

/*
|--------------------------------------------------------------------------
| Controllers - User
|--------------------------------------------------------------------------
*/
require_once __DIR__ . '/../app/controllers/ProductController.php';
require_once __DIR__ . '/../app/controllers/CartController.php';
require_once __DIR__ . '/../app/controllers/ReservationController.php';

/*
|--------------------------------------------------------------------------
| Controllers - Admin
|--------------------------------------------------------------------------
*/
require_once __DIR__ . '/../app/controllers/AdminUserController.php';
require_once __DIR__ . '/../app/controllers/AdminCategoryController.php';
require_once __DIR__ . '/../app/controllers/AdminProductController.php';
require_once __DIR__ . '/../app/controllers/AdminReservationController.php';
