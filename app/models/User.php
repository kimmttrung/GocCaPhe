<?php

class User {

    public static function findByEmail($email) {
        $db = require __DIR__ . '/../config/database.php';

        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$email]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
