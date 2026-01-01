<?php
include "db.php";
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
?>
