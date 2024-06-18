<?php
	session_start();
	include("db.php");
	if(!isset($_SESSION['login_user'])) {
	    header('location:index.php');
	}
?> 
<?php
include('birth-db-connection.php')
?>;
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-qr2qNTEQQ6ye2Sox3SQWfyKhp6L6P6B/B1D4FuDo3zjcJS6UebtEkFu0efbeM9MzEf32j+gRdGBCezxwA9QOyw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	<!-- My CSS -->
	<link rel="stylesheet" href="style.css">

	<title>LIBS-Admin Pannel</title>
	<style>
		main{
			background-color:#5c9599;
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
					<hr>
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
				<a href="web-site/index.php">
				<i class='bx bxs-shopping-bag-alt' ></i>
					<span class="text">LIBS-Web-Site</span>
				</a>
			</li>
			<li>
				<a href="image-update.php">
					<i class='bx bxs-shopping-bag-alt' ></i>
					<span class="text">Image-Section</span>
				</a>
			</li>
			<li>
				<a href="user-data.php">
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
				<a href="payment.php">
					<i class='bx bxs-group' ></i>
					<span class="text">Payment-Deatils</span>
				</a>
			</li>
			<li>
				<a href="password-email.php">
					<i class='bx bxs-group' ></i>
					<span class="text">Password-Send</span>
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
				<a href="logout.php" class="logout">
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
		<main>
			<div class="head-title">
				<div class="left">
					<h1>Dashboard</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#">Home</a>
						</li>
					</ul>
				</div>
				<!-- <a href="#" class="btn-download">
					<i class='bx bxs-cloud-download' ></i>
					<span class="text">Download PDF</span>
				</a> -->
			</div>

			<ul class="box-info">
				<li>
					<i class='bx bxs-calendar-check' ></i>
					<span class="text">
						<h3>1020</h3>
						<p>Total People's</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-group' ></i>
					<span class="text">
						<h3>2834</h3>
						<p>Childre's</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-dollar-circle' ></i>
						<span class="text">
							<h3>$2543</h3>
							<p>Elder People</p>
						</span>
					</li>
					<li>
						<i class='bx bxs-dollar-circle' ></i>
						<span class="text">
						<?php
							$todayDate = date("Y-m-d");
							$sql = "SELECT COUNT(*) AS birthdayCount FROM donations WHERE DAY(dob) = DAY('$todayDate') AND MONTH(dob) = MONTH('$todayDate')";
							$result = $conn->query($sql);

							if ($result->num_rows > 0) {
								$row = $result->fetch_assoc();
								$birthdayCount = $row['birthdayCount'];
							}
						?>
						 	<a href="donation-deatils-birthday.php">
            					<?php echo $birthdayCount; ?>
        					</a>
							<p>Today-BirthDay</p>
						</span>
					</li>
					<li>
						<img src="img/pngwing.com.png" alt="Razorpay Logo" width="100" height="30">
						<span class="text">
							<!-- <h3>Razorpay</h3> -->
							<a href="web-site/key_update.php"><p>Update APL Key</p></a>
						</span>
					</li>

				</ul>
 <div class="table-data">
    <div class="order">
        <div class="head">
            <h3>Recent Donation</h3>
            <i class='bx bx-search'></i>
            <i class='bx bx-filter'></i>
        </div>
        <?php
        $host = "localhost";
        $username = "root";
        $password = "";
        $dbname = "prakash";

        $conn = new mysqli($host, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $result = $conn->query("SELECT * FROM orders");

        if ($result->num_rows > 0) {
            echo "<div class='table-responsive'>
                    <table>
                        <thead>
                            <tr>
                                <th>Order-Id</th>
                                <th>Status</th>
                                <th>Email-ID</th>
								<th>Price</th>
								<th>Payment-ID</th>
                            </tr>
                        </thead>
                        <tbody>";

            while ($row = $result->fetch_assoc()) {
                $statusClass = ($row['status'] == 'success') ? 'completed' : 'pending';

                echo "<tr>
						
                        <td>{$row['order_id']}</td>
                        <td>{$row['razorpay_payment_id']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['price']}</td>
						
						<td><span class='status $statusClass'>{$row['status']}</span></td>
                    </tr>";
            }

            echo "</tbody></table></div>";
        } else {
            echo "<p>No payment records found</p>";
        }

        // Close the database connection
        $conn->close();
        ?>
    </div>
</div>

				
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
	

	<script src="script.js"></script>
</body>
</html>