<?php
include 'db.php';
$email = $_POST['email'] ?? '';
$mobile = $_POST['mobile'] ?? '';

if (empty($email) || empty($mobile)) {
  echo "<script>alert('Please fill all fields!'); window.history.back();</script>";
  exit;
}


$sql = "SELECT * FROM users WHERE email='$email' AND mobile='$mobile'";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
  
  header("Location:verify.html");
  exit;
} else {
  echo "<script>alert('Email and Mobile do not match any record!'); window.history.back();</script>";
}

$conn->close();
?>
