<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "libs-update-trust";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT username, password FROM user";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Login Information</h2>";
    echo "<table border='1'>";
    echo "<tr><th>Username</th><th>Password (Hashed)</th></tr>";
    while ($row = $result->fetch_assoc()) {
        $hashedPassword = hash('sha256', $row['password']); 
        echo "<tr><td>{$row['username']}</td><td>{$hashedPassword}</td></tr>";
    }
    echo "</table>";
} else {
    echo "No login information found.";
}

$conn->close();
?>
