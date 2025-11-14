<?php
include 'db.php'; 


$name = trim($_POST['name']);
$mobile = trim($_POST['mobile'] );
$pincode = trim($_POST['pincode']);
$state = trim($_POST['state'] );
$area = trim($_POST['area'] );
$type = trim($_POST['type']);


if (empty($name) || empty($mobile) || empty($pincode) || empty($state) || empty($area) || empty($type)) {
    echo "<script>
        alert('Please fill in all fields.');
        window.location.href='pickup.html';
    </script>";
    exit;
}


$sql = "INSERT INTO pickup (name, mobile, pincode, state, area, type) 
        VALUES (?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("siisss", $name, $mobile, $pincode, $state, $area, $type);

if ($stmt->execute()) {
    echo "<script>
        alert('Pickup request submitted successfully!');
        window.location.href='home.html';
    </script>";
} else {
    echo "<script>
        alert('Error: Unable to submit request. Please try again.');
        window.location.href='pickup.html';
    </script>";
}

$stmt->close();
$conn->close();
?>
