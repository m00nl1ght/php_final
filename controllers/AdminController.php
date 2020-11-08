<?php

class AdminController {

    public function index() {
        include_once $_SERVER["DOCUMENT_ROOT"] . '/view/admin.php';

        return true;
    }

}