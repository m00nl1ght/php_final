<?php

class User {

    public static function getUserByEmail($email) {
        $pdo = DB::getConnection();

        $stmt = $pdo->prepare("SELECT password FROM users WHERE email = ?");

        $stmt->execute([$email]);
    
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row['password'];
    }

    public static function getRolesByUser($userLogin) {
        $pdo = Db::getConnection();
       
        $stmt = $pdo->prepare("SELECT roles.name FROM roles
        JOIN role_user ON role_user.role_id = roles.id
        JOIN users ON users.id = role_user.user_id
        WHERE users.email = ?");

        $stmt->execute([$userLogin]);

        $rolesArr = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $rolesArr;
    }

}