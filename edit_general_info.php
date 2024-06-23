<?php
include 'config.php';
session_start();

if ($_SESSION['role'] != 'admin'){
    header('Location: profile.php');
}

?>