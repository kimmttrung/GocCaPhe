<?php
include "check_login.php";
if ($_SESSION['role'] != 'admin') die("Không có quyền");
?>
