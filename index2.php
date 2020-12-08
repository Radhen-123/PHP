<?php
//set default value of variables for initial page load
    $password = '';
    if (!isset($name))
    {
        $name = '';
    }
    if (!isset($password))
    {
        $password = '';
    }
    if (!isset($email))
    {
        $email = '';
    }
    if (!isset($age))
    {
        $age = '';
    }
    if (!isset($address))
    {
        $address = '';
    }
    if (!isset($city))
    {
        $city = '';
    }
    if (!isset($province))
    {
        $province = '';
    }
    if (!isset($postcode))
    {
        $postcode = '';
    }
    if (!isset($membership))
    {
        $membership = 'select';
    }
?>
<!DOCTYPE html>
<html lang = "en">
<head>
    <meta charset = "UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale = 1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href= "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>
        Gym Sign up
    </title>
</head>
<body>
    <header>
        <h2>Best Gym</h2>
        <h1>Global Gym Center</h1>
        <div class=""></div>
    </header>
    <form action = "results.php" method="post">
        <h2 style="text-align: center">Personal Detail</h2>
        <div class="justify">
<!--            This code checks to see if we got an error message from the result.php page-->
            <div class="placeholder">
                <?php
                    if (!empty($name_error))
                    {
                        print '<p class = "error">'. htmlspecialchars($name_error) .'</p>';
                    }
                ?>
            </div>
            <label for="name">Name: </label><input type="text" placeholder="John Smith" id="name" name="name" value="<?php print htmlspecialchars($name) ?>"><span class="icone"><i class="fa fa-user icon"></i></span>
            <div class="placeholder">
                <!--            This code checks to see if we got an error message from the result.php page-->
                <?php
                    if (!empty($password_error))
                    {
                        print '<p class = "error">'.htmlspecialchars($password_error).'</p>';
                    }
                ?>
            </div>
            <label for="password">Password: </label><input type="password" id="password" name="password" placeholder="Password" value="<?php print htmlspecialchars($password) ?>"><span class="icone"><i class="fa fa-key icon"></i> </span>
            <div class="placeholder">
                <!--            This code checks to see if we got an error message from the result.php page-->
                <?php
                    if (!empty($email_error))
                    {
                        print '<p class = "error">'.htmlspecialchars($email_error).'</p>';
                    }
                ?>
            </div>
            <label for="email">E-Mail: </label><input type="email" id="email" name="email" placeholder="John.Smith@xyz.com" value="<?php print htmlspecialchars($email) ?>"><span class="icone"><i class="fa fa-envelope icon"></i></span>
            <div class="placeholder">
                <!--            This code checks to see if we got an error message from the result.php page-->
                <?php
                    if (!empty($age_error))
                    {
                        print '<p class = "error">'.htmlspecialchars($age_error).'</p>';
                    }
                ?>
            </div>
            <label for="age">Age: </label><input type="text" id="age" placeholder="e.g 20" name="age" value="<?php print htmlspecialchars($age) ?>"><br><span class="icone"><i class="fa fa-male icon" style="font-size: 40px; transform: translateY(-30px)"></i></span>
            <div class="placeholder"></div>
            <label for = "gender" >Gender: </label>
            <select name = "gender" id = "gender" class="select">
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select><span class="icone"><i class="fa fa-venus-mars icon" style="font-size: 25px; transform: translateX(33px)"></i></span><br>
            <div class="placeholder">
                <!--            This code checks to see if we got an error message from the result.php page-->
                <?php
                    if (!empty($membership_error))
                    {
                        print '<p class = "error">'.htmlspecialchars($membership_error).'</p>';
                    }
                ?>
            </div>
            <label for = "membership">Membership: </label>
            <select name="membership" id="membership" class="select">
                <option value="select">Select your membership</option>
                <option value="Yearly">Yearly</option>
                <option value="Session">Monthly</option>
                <option value="Pay as you go">Pay as you go</option>
            </select>
            <div class="placeholder">
                <!--            This code checks to see if we got an error message from the result.php page-->
                <?php
                    if (!empty($address_error))
                    {
                        print '<p class = "error">'.htmlspecialchars($address_error).'</p>';
                    }
                ?>
            </div>
            <label for = "address">Address: </label><input type="text" id="address" placeholder="Address" name="address" value="<?php print htmlspecialchars($address) ?>"><span class="icone"><i class="fa fa-address-card icon"></i> </span>
            <div class="placeholder">
                <!--            This code checks to see if we got an error message from the result.php page-->
                <?php
                    if (!empty($city_error))
                    {
                        print '<p class = "error">'.htmlspecialchars($city_error).'</p>';
                    }
                ?>
            </div>
            <label for = "city">City: </label><input type="text" id="city" placeholder="City Name" name="city" value="<?php print htmlspecialchars($city) ?>"><span class="icone"><i class="fa fa-map-marker icon" style="font-size: 30px"></i> </span>
            <div class="placeholder">
                <!--            This code checks to see if we got an error message from the result.php page-->
                <?php
                    if (!empty($province_error))
                    {
                        print '<p class = "error">'.htmlspecialchars($province_error).'</p>';
                    }
                ?>
            </div>
            <label for = "province">Province: </label><input type="text" id="province" placeholder="Province" name="province" value="<?php print htmlspecialchars($province) ?>">
            <div class="placeholder">
                <!--            This code checks to see if we got an error message from the result.php page-->
                <?php
                    if (!empty($postcode_error))
                    {
                        print '<p class = "error">'.htmlspecialchars($postcode_error).'</p>';
                    }
                ?>
            </div>
            <label for = "postcode">Post Code: </label><input type="text" id="postcode" placeholder="Post Code" name="postcode" value="<?php print htmlspecialchars($postcode) ?>"><br>
            <label for="locker" style="transform: translateY(15px); position: absolute">Required Locker</label><input type="checkbox" name="locker" value= "Yes" id="locker" style="margin-top: 25px">
            <input type="submit" value="Submit" class="submit">
        </div>
    </form>
</body>
</html>