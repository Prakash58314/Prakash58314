<?php
include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // username and password
    $email = mysqli_real_escape_string($dbconfig, $_POST['email']);
    $fullname = mysqli_real_escape_string($dbconfig, $_POST['fullname']);
    $password = mysqli_real_escape_string($dbconfig, $_POST['password']);
    $password = md5($password);
    $sql = "INSERT INTO user(password, fullname, email) VALUES ('$password', '$fullname', '$email')";
    $result = mysqli_query($dbconfig, $sql);
    $msg = "Registered";
    // After
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <style>
        body {
            background-color: #f5f5f5;
        }
        .container {
            margin-top: 80px;
        }
        .form-container {
            background-color: transparent;
            border-radius: 15px;
            padding: 50px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .btn-primary {
            background-color: #337ab7;
            border-color: #2e6da4;
        }
        .btn-primary:hover,
        .btn-primary:focus {
            background-color: #286090;
            border-color: #204d74;
        }
        a {
            color: #337ab7;
        }
        a:hover,
        a:focus {
            color: #23527c;
        }
        .logo {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
    <title>Registration</title>
</head>
<body>
    <div class="container">
        <div class="row"><br><br><br>
            <div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
                <div class="logo">
                    <img src="" alt="Logo" width="150">
                </div>
                <form method="post" action="">
                    <div class="form-container">
                        <div class="form-group">
                            <input type="text" class="form-control" required="true" placeholder="Full Name" id="fullname" name="fullname" />
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" required="true" placeholder="Password" id="password" name="password" />
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" required="true" placeholder="Email" id="email" name="email" />
                        </div>
                        <?php if (isset($msg)) {
                            echo "<div class='alert alert-success' role='alert'>
                                    <span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span>
                                    <span class='sr-only'>Error:</span>" . $msg . "</div>";
                        } ?>
                        <div class="form-group">
                            <button type="submit" class="btn btn-block btn-primary">Register</button>
                        </div>
                        <center><a href="index.php">Go to login</a></center>
                    </div>
                </form>
                <br>
            </div>
        </div>
    </div>
</body>
</html>
