<?php

class Order {

    public static function storeCustomer($params) {
        $pdo = DB::getConnection();

        $stmt = $pdo->prepare(
            "INSERT customers(surname, name, patronymic, city, street, home, aprt, email, phone)
            VALUES (:surname, :name, :patronymic, :city, :street, :home, :aprt, :email, :phone);"
        );

        $stmt->execute([
            ':surname' => $params['surname'],
            ':name' => $params['name'],
            ':patronymic' => $params['thirdName'],
            ':city' => $params['city'],
            ':street' => $params['street'],
            ':home' => $params['home'],
            ':aprt' => $params['aprt'],
            ':email' => $params['email'],
            ':phone' => $params['phone']
        ]);

        if($stmt) {
            $id = $pdo->lastInsertId();
            return $id;
        }
       
        return false;
    }

    public static function store($params) {
        $pdo = DB::getConnection();

        $stmt = $pdo->prepare(
            "INSERT orders(price, delivery, payment, comment, status, customer_id)
            VALUES (:price, :delivery, :payment, :comment, :status, :customer_id);"
        );

        $customerId = Order::storeCustomer($params);

        if ($customerId) {
            $stmt->execute([
                ':price' => $params['price'],
                ':delivery' => $params['delivery'],
                ':payment' => $params['pay'],
                ':comment' => $params['comment'],
                ':status' => 'new',
                ':customer_id' => $customerId
            ]);

            return $stmt;
        } else {
            return false;
        }
    }

    public static function getOrders($status = 'new') {
        $pdo = DB::getConnection();

        $stmt = $pdo->prepare("SELECT orders.id AS 'order_id', orders.*, customers.* FROM orders JOIN customers 
        ON orders.customer_id = customers.id 
        WHERE orders.status = ?");  

        $stmt->execute([$status]);

        $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $arr;
    }

    public static function changeStatus($id, $status) {
        $pdo = DB::getConnection();
  
        if($status == 'completed') {
            $sql = "UPDATE orders SET status = 'completed' WHERE id = ?";
        }
    
        if($status == 'new') {
            $sql = "UPDATE orders SET status = 'new' WHERE id = ?";
        }  
  
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        
        return $stmt;
    }
}