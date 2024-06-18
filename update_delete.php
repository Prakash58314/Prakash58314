<?php
$conn = new mysqli("localhost", "root", "", "image_gallery");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle image deletion
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $delete_sql = "DELETE FROM images WHERE id = $delete_id";

    if ($conn->query($delete_sql) === TRUE) {
        echo "Image deleted successfully.";
    } else {
        echo "Error deleting image: " . $conn->error;
    }
}

// Fetch and display images with update and delete links
$sql = "SELECT * FROM images";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>";

    while ($row = $result->fetch_assoc()) {
        $imagePath = 'uploads/' . $row['image_name'];
        $imageDescription = $row['image_description'];

        echo "<tr>
                <td>{$row['id']}</td>
                <td><img src='$imagePath' alt='$imageDescription' height='100'></td>
                <td>{$imageDescription}</td>
                <td>
                    <a href='update.php?id={$row['id']}'>Update</a> | 
                    <a href='update_delete.php?delete_id={$row['id']}'>Delete</a>
                </td>
            </tr>";
    }

    echo "</table>";

    // Redirect to another page (index.php) after 3 seconds
    echo "<script>
            setTimeout(function() {
                window.location.href = 'dashboard.php';
            }, 3000);
          </script>";
} else {
    echo "No images found.";
}

$conn->close();
?>
