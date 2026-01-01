<?php
include "check_login.php";
if ($_SESSION['role'] == 'user') die("Không có quyền");
?>
