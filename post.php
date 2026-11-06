<?php
include "connect.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($name !== '' && filter_var($email, FILTER_VALIDATE_EMAIL) && $password !== '') {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = mysqli_prepare($conn, "INSERT INTO users (name, email, password) VALUES (?, ?, ?)");

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "sss", $name, $email, $hashedPassword);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
    }

    header("Location: fetch.php");
    exit;
} 
