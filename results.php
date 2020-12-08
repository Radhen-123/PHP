<?php

//Initialization of variables

    $name = $_POST['name'];
    $password = $_POST['password'];
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $age = filter_input(INPUT_POST, 'age', FILTER_VALIDATE_INT);
    $address = $_POST['address'];
    $city = $_POST['city'];
    $province = $_POST['province'];
    $postcode = $_POST['postcode'];
    $gender = $_POST['gender'];
    $membership = $_POST['membership'];

    if (isset($_POST['locker']))
    {
        $locker = "Yes";
    }
    else
    {
        $locker = "No";
    }

//Validation Section i.e. Validate Values of password name address age.....
    if (strlen($name) < 6)
    {
        $name_error = "The Name is too short";
    }

    if (strlen($password) < 6)
    {
        $password_error = "The password is too short";
    }

    if (empty($email))
    {
        $email_error = 'Please enter valid email id';
    }

    if (empty($age))
    {
        $age_error = 'Please insert valid input';
    }
    elseif ($age > 90)
    {
        $age_error = 'Doing Gym at the age of '.$age.' is dangerous';
    }
    elseif ($age < 18)
    {
        $age_error = 'You are too small to join Gym';
    }

    if (strlen($address) < 6)
    {
        $address_error = "The address is too short to locate you";
    }

    if (strlen($city) < 4)
    {
        $city_error = "The name of city is too short";
    }

    if (strlen($province) < 6)
    {
        $province_error = "The name of province is too short";
    }

    if (strlen($postcode) < 4)
    {
        $postcode_error = "The postcode is too short";
    }

    if ($membership == 'select')
    {
        $membership_error = "Please select your plane";
    }
//If there is error then this code will relode index.php page and dont allows to run this page code
    if (!empty($name_error) || !empty($password_error) || !empty($email_error) || !empty($age_error) || !empty($address_error) || !empty($city_error) || !empty($province_error) || !empty($postcode_error) || !empty($membership_error))
    {
        include('index2.php');
        exit();
    }
?>
<!DOCTYPE html>
<html lang = "en">
<head>
    <meta charset = "UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale = 1.0">
    <title>
        Gym Card
    </title>
    <link rel="stylesheet" href= "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        /*Style Result.php page*/
        body {
            background-color: #f2f2f2;
        }
        .container {
            width: 450px;
            padding: 10px;
            margin: 80px auto auto;
            background-color: #f2f2f2;
            border-radius: 10px;
            box-shadow: 0 -12px 10px white, 6px 12px 15px rgba(0, 0, 0, 0.15), -6px 0 15px rgba(0, 0, 0, 0.15);
        }
        .user {
            border: 0.8em solid #b27ac7;
            position: relative;
            border-radius: 50%;
            height: 7em;
            width: 7em;
            margin: auto;
            transform: translateY(-70px);
            background-color: #f2f2f2;
            box-shadow: 0 -12px 10px white;
        }
        p {
            color: #b27ac7;
            font-size: 1.4em;
            margin: 35px 10px;
        }
        span {
            color: #5d5d5d;
            float: right;
        }
        button {
            padding: 10px;
            font-size: 1.3em;
            background-color: #f2f2f2;
            margin: 20px 50%;
            transform: translateX(-50%);
            border-radius: 30px;
            border: none;
            box-shadow: 0 -5px 10px white, 6px 12px 15px rgba(0, 0, 0, 0.15), -6px 0 15px rgba(0, 0, 0, 0.15);
        }
        a {
            color: #b27ac7;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
<!--        User Icone From font-awsome-->
        <div class="user">
            <i class="fa fa-user icon" style="font-size: 6em; padding-left: 22px; color: #b27ac7"></i>
        </div>
<!--        Display All given values-->
        <p>Name: <span><?php print $name ?></span></p>
        <p>Email: <span><?php print $email ?></span></p>
        <p>Age: <span><?php print $age ?></span></p>
        <p>Gender: <span><?php print $gender ?></span></p>
        <p>Address: <span><?php print $address.', <br>'.$city.', <br> '.$postcode.', <br>'.$province ?></span></p><br>
        <p>Membership: <span><?php print $membership ?></span></p>
        <p>Locker: <span><?php print $locker ?></span></p>
    </div>
    <button><a href = "index.php">New&nbsp;Entry</a></button>
</body>

