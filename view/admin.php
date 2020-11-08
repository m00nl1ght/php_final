<?php

$firstTime = true;
$userLogin = '';
$userPassword = '';

session_start();

//проверка выхода из приложения
if (!empty($_GET['loginOut']) && $_GET['loginOut'] == 'true'){
  $_SESSION = [];
}

//проверка аутентификации
if (Auth::isAuth() == false) {
    if (!empty($_POST)) {
        $userLogin = $_POST['login'];
        $userPassword = $_POST['password'];
        $firstTime = false;

        $errors = Auth::checkUserByLogin($userLogin, $userPassword);

        if (!$errors) {
            $_SESSION['userLogin'] = $userLogin;
            setcookie('login', $userLogin, time() + 60*60*24*30, '/');
        }
    }
} else {
    $firstTime = false;
    $userLogin = $_SESSION['userLogin'];
    $_SESSION['userLogin'] = $userLogin; //обновить сессию
    setcookie('login', $userLogin, time() + 60*60*24*30, '/');
}

if (Auth::isAuth() == false) {
    include $_SERVER['DOCUMENT_ROOT'] . '/view/layout/head.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/view/layout/admin/authorization.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/view/layout/footer.php';

} else {
    header("Location: /admin/orders");
    exit;
}



session_write_close();

// $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
// $segments = explode('/', trim($uri, '/'));

// if($segments[0] === 'admin') {
//     $file = 'admin.php';
// } else {
//     if($uri === '/')
//         $file = 'main.php';
//     else
//         $file = '404.php';
// }