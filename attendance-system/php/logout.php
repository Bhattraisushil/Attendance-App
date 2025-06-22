<?php
session_start();
session_destroy();

if (isset($_GET['admin'])) {
    header("Location: ../pages/admin.php");
} else {
    header("Location: ../pages/login.php");
}
exit;
