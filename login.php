<?php
include 'db.php';

$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

if (empty($email) || empty($password)) {
    echo "<script>alert('Enter both email and password'); window.location.href='login.html';</script>";
    exit;
}

$sql = "SELECT * FROM users WHERE email=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();

    
    $login_success = (substr($user['password'],0,4)==='$2y$') ? 
                        password_verify($password, $user['password']) : 
                        ($password === $user['password']);

    if ($login_success) {
        // Set localStorage using JS
        echo "<script>
            localStorage.setItem('isLoggedIn', 'true');
            localStorage.setItem('first_name', '{$user['first_name']}');
            alert('Login Successful! Welcome, {$user['first_name']}');
            window.location.href='home.html';
        </script>";
    } else {
        echo "<script>alert('Incorrect password'); window.location.href='login.html';</script>";
    }
} else {
    echo "<script>alert('Email not found. Please register first.'); window.location.href='register.html';</script>";
}

$stmt->close();
$conn->close();
?>
