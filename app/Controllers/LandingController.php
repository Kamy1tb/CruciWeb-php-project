<?php

class LandingController {
    private $userModel;

    public function __construct() {
    }

    public function index() {
        require_once __DIR__ . '/../Views/landing.php';
    }


}
?>