<?php
include "database.php";
session_start();
$crud = new crud();





$result = $crud->connect->query("SELECT * FROM products");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-Commerce Website</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card:hover {
            transform: scale(1.05);
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);
        }


        .card {
            height: 100%;
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;


        }

        .card-img-top {
            height: 200px;

            object-fit: cover;
            width: 100%;
        }

        .card-title {
            height: 50px;
            font-size: 1.2rem;
            font-weight: bold;
            text-align: center;
            overflow: hidden;
        }


        .card-text {
            font-size: 1rem;
            text-align: center;
            margin-bottom: 10px;
        }

        .card-body .mt-auto {
            margin-top: auto;
        }

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
                    <li class="nav-item"><a class="nav-link" href="login.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4 cont-c">
        <div class="row">
            <?php while ($row = $result->fetch_assoc()) { ?>
                <div class="col-md-4 d-flex">
                    <div class="card w-100">
                        <img src="images/<?= $row['img']; ?>" class="card-img-top" alt="Product">
                        <div class="card-body">
                            <h5 class="card-title"><?= $row['name']; ?></h5>
                            <p class="card-text">
                                <del class="text-muted">$<?= $row['price']; ?></del>
                                <strong class="text-danger">$<?= $row['dis_price']; ?></strong>
                            </p>
                            <div class="mt-auto d-flex gap-3">
                                <a href="cart.php?id=<?=$row['id'];?>" class="btn btn-primary w-50">Add to Cart</a>
                                <a href="order.php?id=<?= $row['id']; ?>" class="btn btn-warning w-50">Buy Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>