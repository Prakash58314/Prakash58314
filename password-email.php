<!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Donation Data</title>
        <link rel="stylesheet" href="style.css">
        <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <style>
            body {
                padding: 20px;
                background-color: #f8f9fa;
                font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
            }
            .logo{
            margin-top: 20px;
                padding-bottom: 10%;
                font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
            }
            .logo .text{
                font-size: 20px;
            }

            nav {
                background-color: #343a40;
                padding: 10px 0;
                color: #fff;
                font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
            }

            nav a {
                color: #fff;
                text-decoration: none;
            }

            nav .navbar-brand {
                font-size: 1.5rem;
                color: #007bff;
            }

            .container {
                background-color:#5c9599;
                padding: 40px;
                padding-left: 25%;
                border-radius: 20px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
                margin-top: 20px;
            }

            h2 {
                color: whitesmoke;
                font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            }

            .table-responsive {
                margin-top: 20px;
                overflow-x: auto;
            }

            table {
                width: 100%;
                background-color:#e3c87f;
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
                font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
            }

            .btn-primary:hover {
                background-color: #0056b3;
                border-color: #0056b3;
            }
            
        </style>
    </head>

    <body>

    <!-- SLIDER BAR -->
        <section id="sidebar">
            <a href="#" class="brand">
                <i class='bx bxs-smile'></i>
                <div class="logo">
        <span class="text">
            <span style="color: #8d0d0d;">L</span>
            <span style="color: rgb(126, 8, 8);">I</span>
            <span style="color: rgb(189, 9, 9);">B</span>
            <span style="color: rgb(255, 116, 116);">S</span>
            <br>
            
            <span style="color: rgb(18, 74, 196);">The Global Connect</span>
        </span>
    </div>

            </a>
            <ul class="side-menu top">
                <li class="active">
                    <a href="dashboard.php">
                        <i class='bx bxs-dashboard' ></i>
                        <span class="">LIBS-Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="image-update.php">
                        <i class='bx bxs-shopping-bag-alt' ></i>
                        <span class="text">Image-Section</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class='bx bxs-doughnut-chart' ></i>
                        <span class="text">User-Data's</span>
                    </a>
                </li>
                <li>
                    <a href="contact-birth.php">
                        <i class='bx bxs-message-dots' ></i>
                        <span class="text">Contact -BirthDay[deatils]</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class='bx bxs-group' ></i>
                        <span class="text">Payment-Deatils</span>
                    </a>
                </li>
            </ul>
            <ul class="side-menu">
                <li>
                    <a href="#">
                        <i class='bx bxs-cog' ></i>
                        <span class="text">Settings</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="logout">
                        <i class='bx bxs-log-out-circle' ></i>
                        <span class="text">Logout</span>
                    </a>
                </li>
            </ul>
        </section>
        <!-- SIDEBAR -->

        <!-- CONTENT -->
        <section id="content">
            <!-- NAVBAR -->
            <nav>
                <i class='bx bx-menu' ></i>
                <a href="#" class="nav-link">Categories</a>
                <form action="#">
                    <div class="form-input">
                        <input type="search" placeholder="Search...">
                        <button type="submit" class="search-btn"><i class='bx bx-search' ></i></button>
                    </div>
                </form>
                <input type="checkbox" id="switch-mode" hidden>
                <label for="switch-mode" class="switch-mode"></label>
                <a href="#" class="notification">
                    <i class='bx bxs-bell' ></i>
                    <span class="num">10+</span>
                </a>
                <a href="#" class="profile">
                    <img src="img/prakash.jpeg">
                </a>
            </nav>
            <!-- NAVBAR -->

            <!-- MAIN -->
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
            echo "<h2 class='mb-4'>User-Password</h2><hr>";
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
        //    Birthday Button
            echo "<div class='text-center download-btn'>
                    <a href='password-email/demo.php' class='btn btn-primary'><i class='fas fa-mouse-pointe'></i>Click-To Password Send </a>
                </div>";

            echo "</div>";
        } else {
            echo "<p class='alert alert-info mt-4'>No results found.</p>";
        }

        $conn->close();
        ?>
   
        <script src="script.js"></script>
    </body>
    </html>