<?php
session_start();

require_once __DIR__ . '/../config/database.php';

/* Middleware */
require_once __DIR__ . '/../app/middleware/auth.php';

/* Controllers */
require_once __DIR__ . '/../app/controllers/AuthController.php';
require_once __DIR__ . '/../app/controllers/HomeController.php';
require_once __DIR__ . '/../app/controllers/ProductController.php';
require_once __DIR__ . '/../app/controllers/CategoryController.php';
