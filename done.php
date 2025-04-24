<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Order Successful</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .success-container {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            flex-direction: column;
        }
        .checkmark {
            font-size: 80px;
            color: green;
        }
    </style>
</head>
<body>

<div class="container success-container">
    <div class="card p-4 shadow-lg border-0">
        <div class="checkmark">✔</div>
        <h2 class="text-success mt-3">Order Placed Successfully!</h2>
        <p class="text-muted">Thank you for shopping with us. Your order will be delivered soon.</p>
        <a href="index.php" class="btn btn-primary mt-3">Continue Shopping</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
