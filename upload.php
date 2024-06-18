<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the form was submitted with a file
    if (isset($_FILES["image"])) {
        $uploadDirectory = './uploads/';
        
        $imageTmpName = $_FILES["image"]["tmp_name"];
        $imageName = basename($_FILES["image"]["name"]);
        $imageDescription = $_POST["image_description"];

        // Create a unique name for the uploaded image
        $newImageName = uniqid() . '_' . $imageName;

        // Set the final destination path
        $destinationPath = $uploadDirectory . $newImageName;

        // Move the temporary file to the destination
        if (move_uploaded_file($imageTmpName, $destinationPath)) {
            echo "Image uploaded successfully.";
            
            // Store the image information in your database (adjust this based on your database structure)
            $conn = new mysqli("localhost", "root", "", "image_gallery");

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "INSERT INTO images (image_name, image_description) VALUES ('$newImageName', '$imageDescription')";

            if ($conn->query($sql) === TRUE) {
                echo " Image information stored in the database.";
                header("location:dashboard.php");
                exit();
            } else {
                echo "Error storing image information in the database: " . $conn->error;
            }

            $conn->close();
        } else {
            echo "Error uploading image.";
        }
    } else {
        echo "No file selected.";
    }
}
?>
