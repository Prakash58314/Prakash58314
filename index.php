<?php
include("db.php");
session_start();

if (!isset($_SESSION['login_user'])) {
    $login_status = "true";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($dbconfig, $_POST['email']);
    $password = mysqli_real_escape_string($dbconfig, $_POST['password']);
    $password = md5($password);

    $sql_query = "SELECT id,fullname FROM user WHERE email = '$email' and password = '$password'";
    $result = mysqli_query($dbconfig, $sql_query);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    $fullname = $row['fullname'];

    if ($count == 1) {
        $_SESSION['login_user'] = $fullname;
        header("location: dashboard.php");
        exit(); 
    } else {
        $error = "Invalid Login Details";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LIBS-Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: #000;
        }
        .wrapper {
            position: relative;
            width: 400px;
            height: 500px;
            background: #4f3075;
            border-radius: 20px;
            padding: 40px;
            overflow: hidden;
        }
       
        @keyframes animate {
            100% {
                filter: hue-rotate(360deg);
            }
        }
        .form-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 100%;
            transition: 1s ease-in-out;
        }
        .wrapper.active .form-wrapper.sign-in {
            transform: translateY(-450px);
        }
        .wrapper .form-wrapper.sign-up {
            position: absolute;
            top: 450px;
            left: 0;
        }
        .wrapper.active .form-wrapper.sign-up {
            transform: translateY(-450px);
        }
        h2 {
            font-size: 30px;
            color: #fff;
            text-align: center;
        }
        .input-group {
            position: relative;
            margin: 30px 0;
        }
        .input-group label {
            position: absolute;
            top: 50%;
            left: 5px;
            transform: translateY(-50%);
            font-size: 16px;
            pointer-events: none;
            transition: .5s;
        }
        .input-group input {
            width: 100%;
            height: 40px;
            font-size: 16px;
            color: #fff;
            padding: 0 5px;
            background: transparent;
            border: none;
            outline: none;
            border-bottom: 2px solid #fff;
        }
        .input-group input:focus~label,
        .input-group input:valid~label {
            top: -5px;
        }
        .remember {
            margin: -5px 0 15px 5px;
        }
        .remember label {
            color: #fff;
            font-size: 14px;
        }
        .remember label input {
            accent-color: #0ef;
        }
        button {
            width: 100%;
            height: 40px;
            background-color: azure;
            font-size: 16px;
            color: #000;
            font-weight: 500;
            cursor: pointer;
            border-radius: 30px;
            border: none;
            outline: none;
        }
        .signUp-link {
            font-size: 14px;
            text-align: center;
            margin: 15px 0;
        }
        .signUp-link p {
            color: #fff;
        }
        .signUp-link p a {
            color: #0ef;
            text-decoration: none;
            font-weight: 500;
        }
        .signUp-link p a:hover {
            text-decoration: underline;
        }
       
    </style>   
</head>
<body>
<div class="wrapper">
    <div class="form-wrapper sign-in">
        <form method="POST">
            <h2>Login</h2>
            <div class="input-group">
                <input class="form-control" id="email" name="email" value="<?= isset($_POST['email']) ? $_POST['email'] : ''; ?>" placeholder="Email-Id" required>
                <label for="email">Email-Id</label>
            </div>
            <div class="input-group">
                <input type="password" class="form-control" id="pwd" name="password" placeholder="Password" required>
                <label for="pwd">Password</label>
            </div>
            <?php if (isset($error)): ?>
                <div class='alert alert-danger' role='alert'>
                    <span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span>
                    <span class='sr-only'>Error:</span><?= $error; ?>
                </div>
            <?php endif; ?>
            <button type="submit">Login</button>
            <div class="signUp-link">
                <p>Don't have an account? <a href="register.php" class="signUpBtn-link">Register</a></p>
            </div>
            <br>
            <div class="f-g">
                <label><a href="forget-password.php">Forget Password ?</label>
            </div>
        </form>
    </div>
</div>
<!-- Bootstrap JS and Popper.js -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
