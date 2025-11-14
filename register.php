<?php

include 'db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    
    $first_name = trim($_POST['first_name']);
    $last_name  = trim($_POST['last_name']);
    $mobile     = trim($_POST['mobile']);
    $email      = trim($_POST['email']);
    $dob        = $_POST['dob'];
    $country    = trim($_POST['country']);
    $state      = trim($_POST['state']);
    $password   = $_POST['password'];
    $retype_password = $_POST['retype_password'];

    
    if ($password !== $retype_password) {
        die("<script>alert('Passwords do not match!'); window.history.back();</script>");
    }


 
    $sql = "INSERT INTO users (first_name, last_name, mobile, email, dob, country, state, password) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssisssss", $first_name, $last_name, $mobile, $email, $dob, $country, $state, $password);

    if ($stmt->execute()) {
        echo "<script>alert('Registration successful!'); window.location.href='login.html';</script>";
    } else {
        echo "<script>alert('Database Error: " . addslashes($stmt->error) . "'); window.history.back();</script>";
    }

    $stmt->close();
}

$conn->close();
?>
