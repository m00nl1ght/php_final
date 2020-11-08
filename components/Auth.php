<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/models/User.php';

class Auth {

    public static function isAuth() {
        if(isset($_SESSION['userLogin'])){
            return true;
        } else {
            return false;
        }
    }

    public static function checkUserByLogin($login, $password) {
        $databasePassword = User::getUserByEmail($login);

        $errors = [];

        if (password_verify($password, $databasePassword)) {
            return false;
        } else {
            $errors[] = "Неверный логин или пароль!";
        }
        return $errors;
    }

    public static function hasRole($role, $userLogin) {
        $roles = User::getRolesByUser($userLogin);

        foreach ($roles as $r) {
            if($r['name'] == $role) {
                return true;
            }
        }

        return false;
    }

}