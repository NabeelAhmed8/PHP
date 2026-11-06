<?php
include "connect.php";
$id = $_GET['id'];
$result = mysqli_query($conn,"SELECT * FROM users WHERE id='$id'");
if(isset($_POST['update'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    mysqli_query($conn,"UPDATE users SET name='$name', email='$email' WHERE id='$id'");
    header("Location: fetch.php");
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
     <form action="" method="post">
        <?php while($row=mysqli_fetch_assoc($result)){?>
            <input type="text" name="name" value="<?php echo $row['name']; ?>" required><br>
            <input type="email" name="email" value="<?php echo $row['email']; ?>" required><br>
        <?php } ?>
        <input type="submit" name="update" value="Update">
    </form>
</body>
</html>