<?php

define('BASE_PATH', dirname(__DIR__)); // Points to /my_project

require_once BASE_PATH . '/../src_backend/controllers/AuthController.php'; // Adjust the path as necessary

$authController = new AuthController();

// Assuming you get JSON data from the request body
$data = json_decode(file_get_contents('php://input'), true);

// Call the registration method on the controller
$authController->register($data);
?>