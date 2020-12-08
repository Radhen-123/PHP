<?php
require_once('database.php');


if (session_status() == PHP_SESSION_NONE)
{
    session_start();
}


$defemail = '';

if (isset($_SESSION['defemail']))
{
    $defemail = $_SESSION['defemail'];
}

if (!isset($email))
{
    $email = '';
}

if (!isset($password))
{
    $password = '';
}

$password_error = '';

if (isset($_SESSION['password_error']))
{
    $password_error = $_SESSION['password_error'];
}

$email_error = '';
if (isset($_SESSION['email_error']))
{
    $email_error = $_SESSION['email_error'];
}

if (isset($_SESSION['email']))
{
    $email = $_SESSION['email'];
}

if (isset($_SESSION['password']))
{
    $password = $_SESSION['password'];
}

$login_message = '';
if (isset($_SESSION['login_message']))
{
    $login_message = $_SESSION['login_message'];
}

?>
<!DOCTYPE html>
<html>
<!-- the head section -->
<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <title>My Guitar Shop</title>
    <link rel="stylesheet" type="text/css" href="main.css" />
</head>

<!-- the body section -->
<body>
<main>
    <h1>Login</h1>
    <h3 class="text-danger"><?php if ($login_message != '') {
            echo $login_message;
        } ?></h3>
    <br><br>
    <form action = "index.php" method="post">

        <h4 class="text-danger"><?php if ($email_error != '') {
            echo $email_error;
            } ?></h4>
        <label for = "email">E-Mail ID: </label>
        <input type = "text" class="form-control" id="email" name="email" value="<?php print htmlspecialchars($defemail); ?>">

        <h4 class="text-danger"><?php if ($password_error != '') {
                echo $password_error;
            } ?></h4>
        <label for = "password">Password: </label>
        <input type = "password" class="form-control" id="password" name="password" value="">
        <br>
        <input type = "submit" value="Login" class="btn btn-success">
    </form>
</main>
</body>
</html>