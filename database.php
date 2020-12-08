<?php
    $dsn = 'mysql:host=localhost;dbname=my_guitar_shop1';
    $username = 'root';
    $dbpassword = '';

    try {
        $db = new PDO($dsn, $username, $dbpassword);
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include('database_error.php');
        exit();
    }
?>