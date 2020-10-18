<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

include $_SERVER['DOCUMENT_ROOT'] . '/inc/helpers.php';
include $_SERVER['DOCUMENT_ROOT'] . '/inc/sql_connect.php';
include $_SERVER["DOCUMENT_ROOT"] . '/inc/auth.php';
include $_SERVER['DOCUMENT_ROOT'] . '/inc/product.php';

$success = false;
$firstTime = true;
$userLogin = '';
$userPassword = '';

session_start();
var_dump(checkLogoPass('1', '1'));
if(!empty($_GET['loginOut']) && $_GET['loginOut'] == 'true'){
  $_SESSION = [];
}

if(isAuth() == false) {
  if(!empty($_POST)) {
      $userLogin = $_POST['login'];
      $userPassword = $_POST['password'];
      $firstTime = false;

                    $success = true;
              $_SESSION['userLogin'] = $userLogin;
              setcookie('login', $userLogin, time() + 60*60*24*30, '/');
      // $link = getConnection();
      // $sql = "SELECT login, password FROM users";
      // $result = mysqli_query($link, $sql);

      // while ($row = mysqli_fetch_array($result)) {
      //     if($row['login'] == $userLogin && password_verify($userPassword, $row['password'])) {
      //         $success = true;
      //         $_SESSION['userLogin'] = $userLogin;
      //         setcookie('login', $userLogin, time() + 60*60*24*30, '/');
  
      //         break;
      //     }
      // }
  }
} else {
  $success = true;
  $firstTime = false;
  $userLogin = $_SESSION['userLogin'];
  $_SESSION['userLogin'] = $userLogin; //обновить сессию
  setcookie('login', $userLogin, time() + 60*60*24*30, '/'); //обновить куки
}

include $_SERVER['DOCUMENT_ROOT'] . '/template/admin/head.php';
include $_SERVER['DOCUMENT_ROOT'] . '/template/admin/header.php';
// include $_SERVER['DOCUMENT_ROOT'] . '/template/header.php';


if(isAuth() == false) {
  include $_SERVER['DOCUMENT_ROOT'] . '/template/admin/authorization.php';
} else {
  if(isset($_GET['page'])) {
    if($_GET['page'] == 'orders') {
      include $_SERVER['DOCUMENT_ROOT'] . '/template/admin/orders.php';
    } elseif($_GET['page'] == 'products') {
      include $_SERVER['DOCUMENT_ROOT'] . '/template/admin/products.php';
    }
  } else {
    include $_SERVER['DOCUMENT_ROOT'] . '/template/admin/products.php';
  }
  
}
session_write_close();
// include $_SERVER['DOCUMENT_ROOT'] . '/template/admin/products.php';
// include $_SERVER['DOCUMENT_ROOT'] . '/template/admin/authorization.php';
// include $_SERVER['DOCUMENT_ROOT'] . '/template/admin/orders.php';
include $_SERVER['DOCUMENT_ROOT'] . '/template/footer.php';

