<?php

include_once "database.php";
$crud = new crud();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Page</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="card shadow" style="width: 400px;">
            <div class="card-body">
                <h3 class="card-title text-center mb-4">Create Account</h3>
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="fullName" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="fullName" name="name" placeholder="Enter your full name"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" name="contact" id="phone" placeholder="Enter your phone number"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password"
                            required>
                    </div>

                    <div class="d-grid">
                        <button type="submit" name="submit" class="btn btn-primary">Sign Up</button>
                    </div>
                </form>
                <?php
                if(isset($_POST['submit'])){
                    $name = $_POST['name'];
                    $email = $_POST['email'];
                    $contact = $_POST['contact'];
                    $password = md5($_POST['password']);
                    $crud->insertData("users", "(name, email, contact, password) VALUES('$name','$email','$contact','$password')");
                $crud->redirect('login.php');
                }
                else{
                    $crud->message('insert failed');
                }

                ?>
                <hr>
                <p class="text-center">Already have an account? <a href="login.php">Login here</a></p>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

</body>

<!-- </html>
<html>
    <body>
        <form action="" method="post">
            Email: <input name="email" type="text" /> <br><br>
            Subject: <input type="text" name="subject"/> <br> <br>
            Message: <br/>
            <textarea name="message" rows="15" cols="40" id=""></textarea><br/><br/>
            <input type="submit" name="esubmit" value="Submit">
        </form>
    </body>
</html> -->
        
 <?php
if (isset($_POST['submit'])) {
    $from = "rishuyadav970822@gmail";
    $subject ="myShop";
    $message = "thank you for signup"; 
    $to = $_POST['email']; 
    $headers = "From: $from";   

    // Send email
    if (mail($to, $subject, $message, $headers)) {
        echo "Mail sent successfully!";
    } 
}
?> 
