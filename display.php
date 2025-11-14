<?php
include 'db.php';

header("Content-Type: text/html; charset=UTF-8");

$state = $_GET['state'] ?? '';

if (empty($state)) {
    echo "<tr><td colspan='5'> No state selected.</td></tr>";
    exit;
}

$sql = "SELECT name, mobile, pincode, area, type FROM pickup WHERE state = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $state);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . htmlspecialchars($row['name']) . "</td>
                <td>" . htmlspecialchars($row['mobile']) . "</td>
                <td>" . htmlspecialchars($row['pincode']) . "</td>
                <td>" . htmlspecialchars($row['area']) . "</td>
                <td>" . htmlspecialchars($row['type']) . "</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='5'>No pickup requests found for this state.</td></tr>";
}

$stmt->close();
$conn->close();
?>
