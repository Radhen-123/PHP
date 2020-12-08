<?php
require_once('database.php');
$user_type_id = filter_input(INPUT_POST, 'user_type', FILTER_VALIDATE_INT);
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$first_name = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_STRING);
$last_name = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'password');
$confirm_password = filter_input(INPUT_POST, 'confirm_password');

$email_error = '';
$fname_error = '';
$lname_error = '';
$password_error = '';
$confirm_password_error = '';
$user_type_id_error = '';

if ($user_type_id == null || $email == FALSE)
{
    $user_type_id_error = 'Please Insert Valid User Type';
}
if ($email == null || $email == FALSE)
{
    $email_error = "Please Enter a valid Email ID";
}

if ($first_name == null || $first_name == FALSE)
{
    $fname_error = "Please Enter First Name";
}

if ($last_name == null || $last_name == FALSE)
{
    $lname_error = "Please Enter Last Name";
}

if ($password == null || $password == FALSE || !preg_match('/^(?=.*[0-9]+.*)(?=.*[A-Z]+.*)(?=.*[a-z]+.*)[0-9a-zA-Z]{6,}$/', $password))
{
    $password_error = "Please Enter Valid Password Contain
                        <ul>
                            <li>6 Character Long</li>
                            <li>One Capital Letter</li>
                            <li>One Lower Case letter</li>
                            <li>One Number</li>
                        </ul>";
}

if ($password != $confirm_password || $confirm_password == false)
{
    $confirm_password_error = "Confirm Password must Match With Password";
}

if ($email_error != '' || $fname_error != '' || $lname_error != '' || $password_error != '' || $confirm_password_error != '' || $user_type_id_error != '')
{
    include ('add_user_form.php');
    exit();
}
else
{
    require_once ('database.php');
    require_once ('db_admin.php');
    $result_responnse = add_admin($email, $password, $first_name, $last_name, $user_type_id);
    include ('index.php');
}
?>
