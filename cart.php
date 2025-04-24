<?php
include "database.php";
$crud = new crud();

session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = $_POST['product_id'];
    if (!isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id] = 1;
    }
    if (isset($_POST['increase'])) {
        $_SESSION['cart'][$product_id]++;
    } elseif (isset($_POST['decrease'])) {
        $_SESSION['cart'][$product_id]--;
        if ($_SESSION['cart'][$product_id] <= 0) {
            unset($_SESSION['cart'][$product_id]); 
        }
    }
}



$result = $crud->connect->query("SELECT * FROM products");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
         .search-container {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-left: 230px;
        }


        .search-box {
            border: 2px solid #ccc;
            border-radius: 25px;
            padding: 8px 15px;
            width: 250px;
            outline: none;
            transition: 0.3s;
        }


        .search-box:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }


        .go-box {
            border: none;
            background-color: #007bff;
            color: white;
            padding: 8px 15px;
            border-radius: 25px;
            cursor: pointer;
            transition: 0.3s;
        }


        .go-box:hover {
            background-color: #0056b3;
        }

        body {
            padding-top: 50px;
            background-color: pink;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">Myshop</a>
            <div class="search-container">
                <input type="search" class="search-box" placeholder="Search Product">
                <button name="search" class="go-box">Go</button>
            </div>


            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto gap-3">

                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php">Products</a></li>
                    <li class="nav-item"><a class="nav-link" href="cart.php">Cart</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h2 class="text-center mb-4">Shopping Cart</h2>
        <div class="row">
            
            <?php
            $total = 0;
            while ($row = $result->fetch_assoc()) {
                $product_id = $row['id'];
                $quantity = $_SESSION['cart'][$product_id] ?? 1;
                $subtotal = $row['dis_price'] * $quantity;
                $total += $subtotal;
            ?>
                <div class="col-md-8">
                    <div class="card mb-3">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="images/<?= $row['img']; ?>" class="img-fluid rounded-start" alt="Product Image">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $row['name']; ?></h5>
                                    <p class="card-text fw-bold text-success">₹<?= $row['dis_price']; ?></p>
                                    <form method="POST" action="">
                                        <input type="hidden" name="product_id" value="<?= $product_id; ?>">
                                        <div class="input-group mb-3" style="max-width: 120px;">
                                            <button class="btn btn-outline-secondary" type="submit" name="decrease">-</button>
                                            <input type="text" class="form-control text-center" name="quantity" value="<?= $quantity; ?>" readonly>
                                            <button class="btn btn-outline-secondary" type="submit" name="increase">+</button>
                                        </div>
                                    </form>

                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Cart Summary</h5>
                        <p>Total: <strong>₹<?= number_format($total, 2); ?></strong></p>
                        <a href="order.php?id=<?= $product_id; ?>" class="btn btn-primary w-100">Checkout</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
