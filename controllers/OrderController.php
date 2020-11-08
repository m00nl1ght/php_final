<?php

include_once $_SERVER["DOCUMENT_ROOT"] . '/models/Order.php';

class OrderController {

    public function adminIndex() {
        $ordersNew = Order::getOrders('new');
        $ordersCompleted = Order::getOrders('completed');

        usort($ordersNew, Helpers::sortArr('datetime'));

        include_once $_SERVER["DOCUMENT_ROOT"] . '/view/admin_order.php';

        return true;
    }

    public function status() {
        $incomePost = json_decode(file_get_contents('php://input'), true);

        $result = Order::changeStatus($incomePost['id'], $incomePost['status']);

        echo $result;

        return true;
    }

    public function store() {
        $result = Order::store($_POST);
        
        if ($result) {
            echo ('success');
        } else {
            echo ('fail');
        }
        
        return true;
    }

}