<?php
if (session_status() == PHP_SESSION_NONE)
{
    session_start();
}
if (!isset($_SESSION['is_valid_admin']))
{
    header('Location: ./Login.php');
}
?>