<?php
include $_SERVER['DOCUMENT_ROOT'] . '/inc/sql_connect.php';
include $_SERVER['DOCUMENT_ROOT'] . '/inc/product.php';
include $_SERVER['DOCUMENT_ROOT'] . '/inc/order.php';
include $_SERVER['DOCUMENT_ROOT'] . '/inc/helpers.php';

$incomePost = json_decode(file_get_contents('php://input'), true);

$link = getConnection();

//создаем покупателя
$sql = "INSERT customers(surname, name, patronymic, city, street, home, aprt, email, phone) VALUES ('" . 
    $_POST['surname'] . "','" .
    $_POST['name'] . "','" .
    $_POST['thirdName'] . "','" .
    $_POST['city'] . "','" .
    $_POST['street'] . "','" .
    $_POST['home'] . "','" .
    $_POST['aprt'] . "','" .
    $_POST['email'] . "','" .
    $_POST['phone'] . 
"');";

$result = mysqli_query($link, $sql);

//прикрепляем заказ к покупателю
$customerId = getCustomerId($_POST['name'], $_POST['surname']);

$sql = "INSERT orders(price, delivery, payment, comment, status, customer_id) VALUES ('" . 
    $_POST['price'] . "','" .
    $_POST['delivery'] . "','" .
    $_POST['pay'] . "','" .
    $_POST['comment'] . "'," .
    'new' . ",'" .
    $customerId .
"');";

$result = mysqli_query($link, $sql);
