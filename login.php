<?php
session_start();
include "database.php";

$crud = new Crud();

if (isset($_POST['done'])) {
    $email = mysqli_real_escape_string($crud->connect, $_POST['email']);
    $password = $_POST['password']; 

    $query = $crud->connect->query("SELECT * FROM users WHERE email='$email'");

    if ($query->num_rows > 0) {
        $row = $query->fetch_assoc();
        
       
        if (password_verify($password, $row['password'])) {
            $_SESSION['user'] = $row['email']; 
            $_SESSION['username'] = $row['username']; 

            header("Location: index.php"); 
            exit();
        } else {
            $_SESSION['error'] = "Incorrect Password!";
            header("Location: login.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "Email not registered!";
        header("Location: login.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .login-container {
            max-width: 400px;
            margin: 100px auto;
            padding: 40px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        .login-btn {
            width: 100%;
        }
        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-container">
            <div class="login-header">
                <h2>Login</h2>
                <p>Welcome back! Please login to your account.</p>
            </div>
            <form method="POST" action="">
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="rememberMe">
                    <label class="form-check-label" for="rememberMe">Remember me</label>
                </div>
                <button type="submit" class="btn btn-primary login-btn" name="done">Login</button>
            </form>
            <div class="text-center mt-3">
                <p>Don't have an account? <a href="signup.php">Sign up</a></p>
            </div>
        </div>
    </div>
</body>
</html>
