<?php
$conn = new mysqli("localhost", "root", "", "image_gallery");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $new_description = $conn->real_escape_string($_POST["new_description"]);

        if ($_FILES["new_image"]["size"] > 0) {
            $new_image_name = $_FILES["new_image"]["name"];
            $new_image_tmp_name = $_FILES["new_image"]["tmp_name"];
            $new_image_type = $_FILES["new_image"]["type"];

            $allowed_types = ["image/jpeg", "image/png", "image/gif"];

            if (in_array($new_image_type, $allowed_types)) {
                $upload_directory = "uploads/";
                $new_destination_path = $upload_directory . $new_image_name;

                if (move_uploaded_file($new_image_tmp_name, $new_destination_path)) {
                    $update_sql = "UPDATE images SET image_name=?, image_description=? WHERE id=?";
                    $stmt = $conn->prepare($update_sql);
                    $stmt->bind_param("ssi", $new_image_name, $new_description, $id);

                    if ($stmt->execute()) {
                        header("Location: new-pannel/dasboard.php?id=$id");
                        exit();
                    } else {
                        echo "Error updating image information: " . $stmt->error;
                    }
                } else {
                    echo "Error uploading image.";
                    exit;
                }
            } else {
                echo "Invalid file type. Only JPEG, PNG, and GIF images are allowed.";
                exit;
            }
        } else {
            $update_sql = "UPDATE images SET image_description=? WHERE id=?";
            $stmt = $conn->prepare($update_sql);
            $stmt->bind_param("si", $new_description, $id);

            if ($stmt->execute()) {
                header("Location: upload.php?id=$id");
                exit();
            } else {
                echo "Error updating image information: " . $stmt->error;
            }
        }
    }

    $fetch_sql = "SELECT * FROM images WHERE id=?";
    $stmt = $conn->prepare($fetch_sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $image_description = $row['image_description'];
        $current_image_name = $row['image_name'];
    } else {
        echo "Image not found.";
        exit;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Image Information</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
       body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    box-sizing: border-box;
}

.container {
    max-width: 500px;
    margin: 20px;
    background-color: #fff;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h2, p {
    text-align: center;
    color: #333;
}

form {
    margin-top: 20px;
}

label {
    display: block;
    margin-bottom: 8px;
    color: #555;
}

textarea,
.form-control {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ddd;
    border-radius: 4px;
    box-sizing: border-box;
    resize: vertical;
}

.img-preview {
    max-width: 100%;
    height: auto;
    margin-top: 15px;
}

.btn-primary {
    background-color: #3498db;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 4px;
    cursor: pointer;
}

.btn-primary:hover {
    background-color: #2980b9;
}

</style>
</head>
<body>
    <div class="container">
        <h2>Update Image Information</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="new_description">New Description:</label>
                <textarea class="form-control" name="new_description" id="new_description" required><?php echo $image_description; ?></textarea>
            </div>
            <div class="form-group">
                <label for="new_image">New Image:</label>
                <input type="file" class="form-control-file" name="new_image" id="new_image">
            </div>
            <div class="form-group">
                <img src="uploads/<?php echo $current_image_name; ?>" alt="Current Image" class="img-fluid">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Update Information" name="submit">
            </div>
        </form>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
