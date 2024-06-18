<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Donation Data</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            padding: 20px;
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }

        nav {
            background-color: #343a40;
            padding: 10px 0;
            color: #fff;
        }

        nav a {
            color: #fff;
            text-decoration: none;
        }

        nav .navbar-brand {
            font-size: 1.5rem;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        h2 {
            color: #007bff;
        }

        .table-responsive {
            margin-top: 20px;
            overflow-x: auto;
        }

        table {
            width: 100%;
            background-color: #fff;
            border-radius: 5px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            text-align: center;
            padding: 15px;
        }

        thead {
            background-color: #343a40;
            color: #fff;
        }

        tbody tr:hover {
            background-color: #f8f9fa;
        }

        .download-btn {
            margin-top: 20px;
        }

        .alert-info {
            background-color: #d1ecf1;
            color: #0c5460;
            border-color: #bee5eb;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Donation Dashboard</a>
        </div>
    </nav>

    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "libs-update-trust";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $sql = "SELECT * FROM donations";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<div class='container mt-4'>";
        echo "<h2 class='mb-4'>Donation - Data</h2>";
        echo "<div class='table-responsive'>";
        echo "<table class='table table-bordered'>";
        echo "<thead class='thead-dark'>";
        echo "<tr><th>ID</th><th>Customer Name</th><th>Email</th><th>Contact No</th><th>DOB</th><th>Price</th></tr>";
        echo "</thead>";
        echo "<tbody>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["id"] . "</td><td>" . $row["customername"] . "</td><td>" . $row["email"] . "</td><td>" . $row["contactno"] . "</td><td>" . $row["dob"] . "</td><td>" . $row["price"] . "</td></tr>";
        }
        echo "</tbody>";
        echo "</table>";
        echo "</div>";

        // Download button
        echo "<div class='text-center download-btn'>
                <a href='download.php' class='btn btn-primary'><i class='fas fa-download'></i> Download as CSV</a>
              </div>";

        echo "</div>";
    } else {
        echo "<p class='alert alert-info mt-4'>No results found.</p>";
    }

    $conn->close();
    ?>

    <!-- Your existing script -->
    <!-- 
     <script>
        setTimeout(function (){
            window.location.href = 'birthday-email.php';
        },10000);
    </script>  -->

</body>

</html>
