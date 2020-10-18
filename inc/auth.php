<?php

function isAuth(){
    if(isset($_SESSION['userLogin'])){
        return true;
    } else {
        return false;
    }
}

function checkLogoPass($login, $password) {
    $link = getConnection();
    $sql = "SELECT email AS login, password FROM users";
    
    $result = mysqli_query($link, $sql);

    while ($row = mysqli_fetch_array($result)) {
        if($row['login'] == $login && password_verify($password, $row['password'])) {
            return true;
        }
    }

    return false;
}

function hasRole($login, $role) {
    $link = getConnection();
    $userLogin = mysqli_real_escape_string($link, $login);
    $sql = "SELECT mybd.groups.name AS user_groups FROM users
        JOIN group_user ON group_user.user_id = users.id
        JOIN mybd.groups ON mybd.groups.id = group_user.group_id
        WHERE users.login='" . $userLogin . "'";
    $result = mysqli_query($link, $sql);
    $result = mysqli_fetch_all($result);
    return $result;
}