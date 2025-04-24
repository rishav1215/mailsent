<?php include_once "database.php"; 
$crud = new crud(); 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-Commerce Website</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">ShopNow</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php">Products</a></li>
                    <li class="nav-item"><a class="nav-link" href="cart.php">Cart</a></li>
                    <li class="nav-item"><a class="nav-link" href="">logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h2 class="text-center">Add New Product</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="productName" class="form-label">Product Name</label>
                <input type="text" class="form-control" id="productName" name="name" placeholder="Enter product name">
            </div>

            <div class="mb-3">
                <label for="productPrice" class="form-label">Original Price ($)</label>
                <input type="number" class="form-control" id="productPrice" placeholder="Enter original price"
                    name="price">
            </div>
            <div class="mb-3">
                <label for="discountPrice" class="form-label">Discount Price ($)</label>
                <input type="number" class="form-control" id="discountPrice" placeholder="Enter discount price"
                    name="dis_price">
            </div>
            <div class="mb-3">
                <label for="productImage" class="form-label">Product Image</label>
                <input type="file" class="form-control" id="productImage" name="img">
            </div>
            <button type="submit" class="btn btn-primary" name="send">Submit</button>
        </form>
        <?php
        if (isset($_POST['send'])) {
            $name = $_POST['name'];
            $price = $_POST['price'];
            $dis_price = $_POST['dis_price'];
            $img = $_FILES['img']['name'];
            $tmp_image = $_FILES['img']['tmp_name'];

            
            $upload_dir = "images/";
            $target_file = $upload_dir . basename($img);

            if (move_uploaded_file($tmp_image, $target_file)) {

                $crud->insertData("products", "(name, price, dis_price, img) VALUES('$name','$price','$dis_price','$img')");
                $crud->redirect('index.php');

            }
            else{
                $crud->message('insert failed');
            }
        }
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>