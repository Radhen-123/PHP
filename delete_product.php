<?php
require_once('database.php');
require_once ('validate.php');

// Get IDs
$product_id = filter_input(INPUT_POST, 'product_id_hidden', FILTER_VALIDATE_INT);
$category_id = filter_input(INPUT_POST, 'category_id_hidden', FILTER_VALIDATE_INT);
$product_code = filter_input(INPUT_POST, 'product_code_hidden', FILTER_SANITIZE_STRING);

// Delete the product from the database
if ($product_id != false && $category_id != false) {
    $query = "DELETE FROM products
              WHERE productID = :product_id";
    $statement = $db->prepare($query);
    $statement->bindValue(':product_id', $product_id);
    $statement->execute();
    $statement->closeCursor();
}
require_once ('file_util.php');
if (is_file($image_dir_path.DIRECTORY_SEPARATOR.$product_code.'.png') )
{
    $path = $image_dir_path.DIRECTORY_SEPARATOR.$product_code.'.png';
    unlink($path);
}

// display the Product List page
include('index.php');
?>