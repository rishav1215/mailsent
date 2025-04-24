<?php 
include "database.php"; 
session_start();
$crud = new crud(); 

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Invalid Product ID");
}

$product_id = $_GET['id'];
$result = $crud->connect->query("SELECT * FROM products WHERE id = '$product_id'");


if ($result->num_rows == 0) {
    die("Product Not Found");
}


$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Buy Now - <?= $row['name']; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card {
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        .btn-custom {
            width: 100%;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="index.php">MyShop</a>
    </div>
</nav>

<div class="container mt-4">
    <div class="row">
        <!-- Product Details -->
        <div class="col-md-6">
            <div class="card p-3">
                <img src="images/<?= $row['img'];?>" class="img-fluid rounded" alt="Product Image">
                <h4 class="mt-3"><?= $row['name'];?></h4>
                <p><del class="text-danger">$<?= $row['price'];?></del> <strong>$<?= $row['dis_price'];?></strong></p>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis nec velit sapien.</p>
            </div>
        </div>

        <!-- Checkout Form -->
        <div class="col-md-6">
            <div class="card p-3">
                <h4>Shipping Details</h4>
                <form action="" method="POST">
                    <input type="hidden" name="product_id" value="<?= $row['id']; ?>">
                    
                    <div class="mb-2">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="fullname" class="form-control" placeholder="Enter your name" required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Address</label>
                        <textarea name="address" class="form-control" rows="2" placeholder="Enter your address" required></textarea>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Phone</label>
                        <input type="text" name="phone" class="form-control" placeholder="Enter your phone number" required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Payment Method</label>
                        <select name="payment_method" class="form-select">
                            <option value="COD">Cash on Delivery (COD)</option>
                            <option value="Card">Credit/Debit Card</option>
                            <option value="UPI">UPI</option>
                        </select>
                    </div>
                        <button class="btn btn-success btn-custom mt-3" name="done">Confirm Order</button>                    
                </form>
                <?php
                    if(isset($_POST['done'])){
                    $fullname = $_POST['fullname'];
                    $address = $_POST['address'];
                    $phone = $_POST['phone'];
                    $payment_method = $_POST['payment_method'];
                    $crud->insertData("orders", "(fullname, address, phone, payment_method) VALUES('$fullname','$address','$phone','$payment_method')");
                    $crud->redirect("done.php");
                    }
                ?>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
