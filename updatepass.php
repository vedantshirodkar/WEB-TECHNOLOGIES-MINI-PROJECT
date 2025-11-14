<?php
session_start();
include 'db.php';
$email = $_SESSION['verified_email'];
$pass1 = $_POST['pass1'] ?? '';
$pass2 = $_POST['pass2'] ?? '';

if (empty($pass1) || empty($pass2)) {
  echo "<script>alert('Please fill all fields!'); window.history.back();</script>";
  exit;
}

if ($pass1 !== $pass2) {
  echo "<script>alert('Passwords do not match!'); window.history.back();</script>";
  exit;
}

$sql = "UPDATE users SET password='$pass1' WHERE email='$email'";
if ($conn->query($sql) === TRUE) {
  session_destroy();
  echo "<script>alert('Password updated successfully! Please login again.'); window.location='login.html';</script>";
} else {
  echo "<script>alert('Error updating password: " . $conn->error . "'); window.history.back();</script>";
}

$conn->close();
?>
