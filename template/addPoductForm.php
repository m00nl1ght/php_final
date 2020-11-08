<?php
include $_SERVER['DOCUMENT_ROOT'] . '/inc/sql_connect.php';

$id = $_POST['product-id'];
$name = $_POST['product-name'];
$price = $_POST['product-price'];

$new = (isset($_POST['new']))?1:0;
$sale = (isset($_POST['sale']))?1:0;

$link = getConnection();

if(empty($id)) {
    $sql = "INSERT products (name, price, new, sale) VALUES ('" .
        $name . "','" .
        $price . "','" .
        $new . "','" .
        $sale . 
    "');";
} else {
    $sql = "UPDATE products SET 
        name = '" . $name . "',
        price = '" . $price . "',
        new = '" . $new . "',
        sale = '" . $sale . "'
          WHERE id = '" . $id . "'";
}

$result = mysqli_query($link, $sql);

if($result) {
    echo 'success';
} else {
    echo ('fail');
}