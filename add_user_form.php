<?php
require_once('database.php');
require_once ('validate.php');
require_once ('validate_super_user.php');

if (!isset($email))
{
    $email = '';
}
if (!isset($first_name))
{
    $first_name = '';
}

if (!isset($last_name))
{
    $last_name = '';
}

if (!isset($password))
{
    $password = '';
}

if (!isset($confirm_password))
{
    $confirm_password = '';
}


require('database.php');
$query = 'SELECT *
          FROM usertypes
          ORDER BY typeID';
$statement = $db->prepare($query);
$statement->execute();
$userTypes = $statement->fetchAll();
$statement->closeCursor();
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
    <h1>User Information</h1>
    <br><br>
    <form action = "add_user.php" method="post">

        <div class="form-group">
            <label>User Types:</label>
            <?php if(isset($category_error) && $category_error != ''){ ?>
                <h3 class='text-danger'><?php echo $category_error; ?></h3>
            <?php } ?>
            <select class="form-control" name="user_type">
                <?php foreach ($userTypes as $userType) : ?>
                    <option value="<?php echo $userType['typeID']; ?>">
                        <?php echo $userType['typeName']; ?>
                    </option>
                <?php endforeach; ?>
            </select><br>
        </div>

        <label for = "username">Username/Email:</label>
        <?php if (isset($email_error))
        {
            print '<h5 class = "text-danger">'.$email_error.'</h5>';
        }?>
        <input type = "text" class="form-control" name="email" id="username" value="<?php print htmlspecialchars($email); ?>">
        <br>

        <label for = "first_name">First Name: </label>
        <?php if (isset($fname_error))
        {
            print '<h5 class = "text-danger">'.$fname_error.'</h5>';
        }?>
        <input type = "text" class="form-control" name="first_name" id="first_name" value="<?php print htmlspecialchars($first_name); ?>">
        <br>

        <label for = "last_name">Last Name: </label>
        <?php if (isset($lname_error))
        {
            print '<h5 class = "text-danger">'.$lname_error.'</h5>';
        }?>
        <input type = "text" class="form-control" name="last_name" id="last_name" value="<?php print htmlspecialchars($last_name); ?>">
        <br>

        <label for = "password">Password: </label>
        <?php if (isset($password_error))
        {
            print '<h5 class = "text-danger">'.$password_error.'</h5>';
        }?>
        <input type = "password" class="form-control" name="password" id="password" value="">
        <br>

        <label for = "confirm_password">Confirm Password: </label>
        <?php if (isset($confirm_password_error))
        {
            print '<h5 class = "text-danger">'.$confirm_password_error.'</h5>';
        }?>
        <input type = "password" class="form-control" name="confirm_password" id="confirm_password" value="">
        <br>

        <input type = "submit" value="Add User" class="btn btn-primary" style="margin-bottom: 10px">
        <br>
    </form>
    <p><br><a href="index.php">View Product List</a></p>
</main>
</body>
</html>