<?php
include "connect.php";
if(isset($_POST['add'])){
    $title=$_POST['title'];
    $description=$_POST['description'];
    $price=$_POST['price'];
    $category=$_POST['category'];
    $image=$_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'],"uploads/".$image);
    $path="http://localhost/WEB25/uploads/".$image;
    mysqli_query($conn,"INSERT INTO products(title,description,price,category,image) VALUES('$title','$description','$price','$category','$path')");
    echo "<script>alert('Product added successfully');</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="text" name="title" placeholder="Title" required><br>
        <textarea name="description" placeholder="Description" required></textarea><br>
        <input type="number" name="price" placeholder="Price" required><br>
        <input type="text" name="category" placeholder="Category" required><br>
        <input type="file" name="image" required><br>
        <input type="submit" name="add" value="Add Product">
    </form>
</body>
</html>