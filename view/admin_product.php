<?php

session_start();

if (Auth::isAuth()) {
    $userLogin = $_SESSION['userLogin'];
    $_SESSION['userLogin'] = $userLogin; //обновить сессию
    setcookie('login', $userLogin, time() + 60*60*24*30, '/');

    include $_SERVER['DOCUMENT_ROOT'] . '/view/layout/head.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/view/layout/admin/header.php';

    if(isset($adminProductPage)) {
        include $_SERVER['DOCUMENT_ROOT'] . '/view/layout/admin/products.php';
    }

    if(isset($adminProductCreatePage) || isset($adminProductEditPage)) {
        include $_SERVER['DOCUMENT_ROOT'] . '/view/layout/admin/product_create.php';
    }

    include $_SERVER['DOCUMENT_ROOT'] . '/view/layout/footer.php';

} else {
    header("Location: /admin/");
    exit;
}
