<?php
if (session_status() == PHP_SESSION_NONE)
{
    session_start();
}
if (!isset($_SESSION['is_valid_administrator']))
{
    header('Location: ./access_error.php');
}
?>