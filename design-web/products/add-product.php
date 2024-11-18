<?php
session_start();
include('../includes/db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $farmer_id = $_SESSION['user_id']; // Assume farmer is logged in

    // Handle image upload
    $image = $_FILES['image']['name'];
    $target = "../assets/images/" . basename($image);
    move_uploaded_file($_FILES['image']['tmp_name'], $target);

    $sql = "INSERT INTO products (name, description, price, image, farmer_id) VALUES ('$name', '$description', '$price', '$image', '$farmer_id')";
    if ($conn->query($sql) === TRUE) {
        echo "Product added successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <form method="POST" enctype="multipart/form-data">
        <h2>Add Product</h2>
        <input type="text" name="name" placeholder="Product Name" required>
        <textarea name="description" placeholder="Product Description" required></textarea>
        <input type="number" name="price" placeholder="Price" required>
        <input type="file" name="image" required>
        <button type="submit">Add Product</button>
    </form>
</body>
</html>
