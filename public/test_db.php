<?php
require_once dirname(__DIR__, 1) . '/config/Database.php';
try {
    $database = new Database();
    $db = $database->connect();
    echo "✅ Database connected successfully!";
} catch (Exception $e) {
    echo "❌ Database connection failed: " . $e->getMessage();
}
