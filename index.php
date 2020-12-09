<?php
require_once('database.php');
require_once ('file_util.php');

if (session_status() == PHP_SESSION_NONE)
{
    session_start();
}

$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$password = filter_input(INPUT_POST, 'password');

unset($_SESSION['email_error']);
unset($_SESSION['password_error']);
unset($_SESSION['typeID']);

if (!isset($_SESSION['defemail']))
{
    $_SESSION['defemail'] = '';
}
$_SESSION['defemail'] = $email;

if (isset($_SESSION['email']))
{
    $email = $_SESSION['email'];
}
elseif( $email === FALSE || $email === '')
{
    $_SESSION['email_error'] = 'Please enter valid Email Id';
}

if (isset($_SESSION['password']))
{
    $password = $_SESSION['password'];
}
elseif (!isset($password))
{
    $_SESSION['password_error'] = '';
}
elseif ($password === FALSE || strlen($password) < 6)
{
    $_SESSION['password_error'] = 'Please provide a password at least 6 character long.';
}

if (isset($_SESSION['password_error']) || isset($_SESSION['email_error']))
{
    header('Location: ./Login.php');
    exit();
}
else
{
    require_once ('database.php');
    require_once ('db_admin.php');
    if (is_valid_admin_login($email, $password))
    {
        $_SESSION['email'] = $email;
        $_SESSION['password'] = $password;
        $_SESSION['is_valid_admin'] = true;
    }
    else
    {
        if (emailExists($email))
        {
            $_SESSION['login_message'] = "Password Incorrect. Please try again";
            header('Location: ./Login.php');
            exit();
        }
        else
        {
            $_SESSION['login_message'] = "Username does not exists. Please try again";
            header('Location: ./Login.php');
            exit();
        }
    }
}

// Get category ID
if (!isset($category_id)) {
  $category_id = filter_input(INPUT_GET, 'category_id', FILTER_VALIDATE_INT);
  if ($category_id == NULL || $category_id == FALSE) {
      $category_id = 1;
  }
}

if (!isset($result_responnse))
{
    $result_responnse = '';
}

// Get name for selected category
$queryCategory = 'SELECT * FROM categories
                      WHERE categoryID = :category_id';
$statement1 = $db->prepare($queryCategory);
$statement1->bindValue(':category_id', $category_id);
$statement1->execute();
$category = $statement1->fetch();
$category_name = $category['categoryName'];
$statement1->closeCursor();

// Get all categories
$queryAllCategories = 'SELECT * FROM categories
                           ORDER BY categoryID';
$statement2 = $db->prepare($queryAllCategories);
$statement2->execute();
$categories = $statement2->fetchAll();
$statement2->closeCursor();

// Get products for selected category
$queryProducts = 'SELECT * FROM products
              WHERE categoryID = :category_id
              ORDER BY productID';
$statement3 = $db->prepare($queryProducts);
$statement3->bindValue(':category_id', $category_id);
$statement3->execute();
$products = $statement3->fetchAll();
$statement3->closeCursor();

$queryName = 'SELECT * FROM administrators
                  WHERE emailAddress = :email';
$statement4 = $db->prepare($queryName);
$statement4->bindValue(':email', $email);
$statement4->execute();
$administrators = $statement4->fetch();
$statement4->closeCursor();

$typeId = $administrators['typeID'];
if (!isset($_SESSION['typeID']))
{
    $_SESSION['typeID'] = $administrators['typeID'];
}

$queryName = 'SELECT * FROM usertypes
                WHERE typeId = :typeId';
$statement5 = $db->prepare($queryName);
$statement5->bindValue(':typeId', $typeId);
$statement5->execute();
$userType = $statement5->fetch();
$statement5->closeCursor();

if ($_SESSION['typeID'] == 3)
{
    $_SESSION['is_valid_super_user'] = true;
    $_SESSION['is_valid_administrator'] = true;
}
elseif ($_SESSION['typeID'] == 2)
{
    $_SESSION['is_valid_administrator'] = true;
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
    <h1>Product List</h1>
    <?php if (isset($result_responnse))
    {
        print '<h5 class = "text-primary">'.$result_responnse.'</h5>';
    }?>

    <?php print '<h3 class="text-primary">Welcome '.$administrators['firstName'].' '.$administrators['lastName'].' '.$userType['typeName'].'</h3>' ?>

    <aside>
            <!-- display a list of categories -->
            <h2>Categories</h2>
            <nav>
            <ul>
                <?php foreach ($categories as $category) : ?>
                <li><a class="btn btn-block
                  <?php if($category['categoryID']==$category_id) {
                           echo "btn-success";
                        } else {
                           echo "btn-outline-success";
                        } ?>"
                        href=".?category_id=<?php echo $category['categoryID']; ?>">
                        <?php echo $category['categoryName']; ?>
                    </a>
                </li>
                <?php endforeach; ?>
            </ul>
            </nav>
        </aside>

    <section>
        <!-- display a table of products -->
        <h2><?php echo $category_name; ?></h2>
        <table class="table table-striped">
          <thead>
              <tr>
                  <th>Code</th>
                  <th>Name</th>
                  <th class="right">Price</th>
                  <th class="right">Images</th>
              </tr>
          </thead>
          <tbody>
              <?php
              foreach ($products as $product) :
                  ?>
              <tr>
                  <td><?php echo $product['productCode']; ?></td>
                  <td><?php echo $product['productName']; ?></td>
                  <td class="right"><?php echo $product['listPrice']; ?></td>
                  <td><?php
                      require_once ('file_util.php');
                      if (is_file($image_dir_path.DIRECTORY_SEPARATOR.$product['productCode'].'.png') )
                      {
                          $path = $image_dir_path.DIRECTORY_SEPARATOR.$product['productCode'].'.png';
                          print "<img src='$path' style='max-width: 150px; max-height: 150px;'>";
                      }
                      else
                      {
                          $path = $image_dir_path.DIRECTORY_SEPARATOR.'noImage.png';
                          print "<img src='$path' style='max-width: 100px; max-height: 100px'>";
                      }
                      ?></td>
                  <td>
                    <!-- We are only showing the Delete button for this form -->
                    <form action="delete_product.php" method="post">

                      <!-- This hidden field is used to store the productID -->
                      <input type="hidden" name="product_id_hidden"
                             value="<?php echo $product['productID']; ?>">

                      <!-- This hidden field is used to store the categoryID -->
                      <input type="hidden" name="category_id_hidden"
                             value="<?php echo $product['categoryID']; ?>">

                        <input type="hidden" name="product_code_hidden"
                               value="<?php echo $product['productCode']; ?>">

                      <!-- This is the button that we actually see -->
                      <input class="btn btn-warning" type="submit" value="Delete">
                    </form>
                  </td>
                  <td>
                    <!-- We are only showing the Delete button for this form -->
                    <form action="update_product_form.php" method="post">

                      <!-- This hidden field is used to store the productID -->
                      <input type="hidden" name="product_id_hidden"
                             value="<?php echo $product['productID']; ?>">

                      <!-- This hidden field is used to store the categoryID -->
                      <input type="hidden" name="category_id_hidden"
                             value="<?php echo $product['categoryID']; ?>">

                      <!-- This is the button that we actually see -->
                      <input class="btn btn-info" type="submit" value="Update">
                    </form>
                  </td>
              </tr>
              <?php endforeach; ?>
          </tbody>
        </table>
        <?php
        if ($_SESSION['typeID'] > 1)
        {
            print '<a class="btn btn-primary" href="add_product_form.php" role="button" style="margin-right: 5px">Add Product</a>';
        }
        if ($_SESSION['typeID'] > 2)
        {
            print '<a class="btn btn-info" href = "add_user_form.php" role = "button" > Add User </a >';
        }
        ?>
        <a class="btn btn-danger" href="logout.php" role="button">Logout</a>
    </section>
</main>
<footer></footer>
</body>
</html>