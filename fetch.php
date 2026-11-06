<?php
include "connect.php";
$result = mysqli_query($conn,"SELECT * FROM users");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Delete</th>
                <th>Update</th>
            </tr>
        </thead>
        <?php while($row=mysqli_fetch_assoc($result)){?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><a href="delete.php?id=<?php echo $row['id']; ?>">Delete</a></td>
                <td><a href="update.php?id=<?php echo $row['id']; ?>">Update</a></td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>