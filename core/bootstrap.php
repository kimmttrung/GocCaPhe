<?php
session_start();

require_once __DIR__ . '/../config/database.php';

/* Middleware */
require_once __DIR__ . '/../app/middleware/auth.php';

/* Controllers */
require_once __DIR__ . '/../app/controllers/AuthController.php';
require_once __DIR__ . '/../app/controllers/HomeController.php';
require_once __DIR__ . '/../app/controllers/AdminProductController.php';
require_once __DIR__ . '/../app/controllers/AdminUserController.php';
require_once __DIR__ . '/../app/controllers/AdminCategoryController.php';

