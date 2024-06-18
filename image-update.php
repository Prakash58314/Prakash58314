<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
      <title>Image-update</title>
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
        table{
            border: 2px solid #0d0f12;
        }
        th,td{
            border: 2px solid #0d0f12;
        }
    </style>
</head>
<body>
    <!-- SIDEBAR -->
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
        <!-- <hr style="border-color: rgb(18, 74, 196);">  -->
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
                <a href="contact-deatils.php">
                    <i class='bx bxs-message-dots' ></i>
                    <span class="text">Contact -Deatils</span>
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
				<img src="img/people.png">
			</a>
		</nav>
            <?php
            $conn = new mysqli("localhost", "root", "", "libs-update-trust");
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            if (isset($_GET['delete_id'])) {
                $delete_id = $_GET['delete_id'];
                $delete_sql = "DELETE FROM images WHERE id = $delete_id";

                if ($conn->query($delete_sql) === TRUE) {
                    echo "Image deleted successfully.";
                } else {
                    echo "Error deleting image: " . $conn->error;
                }
            }

            $sql = "SELECT * FROM images";
            $result = $conn->query($sql);

            if ($result->num_rows > 0): ?>
                <div class="container mt-5">
                    <div class="row">
                        <div class="col-md-12">
                            <h2 class="text-center text-litegreen mb-2">Image-Operation</h2>
                            <a href='add.php' class="btn btn-success mb-2">Add Image</a>
                  
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Image</th>
                                            <th>Description</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($row = $result->fetch_assoc()): ?>
                                            <tr>
                                                <td><?php echo $row['id']; ?></td>
                                                <td>
                                                    <img src='uploads/<?php echo $row['image_name']; ?>' alt='<?php echo $row['image_description']; ?>' class='img-fluid' height='60' width='80'>
                                                </td>
                                                <td><?php echo $row['image_description']; ?></td>
                                                <td>
                                                    <a href='update.php?id=<?php echo $row['id']; ?>' class="btn btn-primary btn-sm mr-2">Update</a>
                                                    <a href='update_delete.php?delete_id=<?php echo $row['id']; ?>' class="btn btn-danger btn-sm">Delete</a>
                                                </td>
                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <p>No images found.</p>
            <?php endif; ?>
           
            <!-- Bootstrap JS and Popper.js (if needed) -->
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

            <script>
                document.addEventListener("DOMContentLoaded", function () {
                    document.querySelector('.animate__animated').classList.add('animate__fadeIn');
                });

               
            </script>
        </div>
    </div>
</div>
</body>
</html>
