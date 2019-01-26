<?php require_once 'functions.php';?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" 
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    
    <?php 
    if(isset($_SESSION['message'])): ?>
        <div class="alert alert-<?=$_SESSION['type']?>">
            <?php 
            echo $_SESSION['message'];
            unset($_SESSION['message']);
            ?>
        </div>
    <?php endif ?>
    
    <?php
        $mysqli = new mysqli('list', 'root', '', 'list') or die(mysqli_error($mysqli));
        $result = $mysqli->query("SELECT * FROM data") or die($mysqli->error);
    ?>
    <div class="container">
        <div class="row justify-content-center">
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Location</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <?php while ($row = $result->fetch_assoc()):?>
                    <tr>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['location']; ?></td>
                        <td>
                            <a href="index.php?edit=<?php echo $row['id'];?>" class="btn btn-info">Edit</a>
                            <a href="functions.php?delete=<?php echo $row['id'];?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php endwhile;?>
            </table>
            <form action="functions.php" method="post">
                <input type="hidden" name="id" value="<?php echo $id?>">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" value="<?php echo $name?>" placeholder="Enter your name">
                </div>
                <div class="form-group">
                    <label for="location">Location</label>
                    <input type="text" class="form-control" name="location" value="<?php echo $location?>" placeholder="Enter your location">
                </div>
                <div class="form-group">
                    <?php if($update):?>
                    <button type="submit" class="btn btn-info" name="update">Update</button>
                    <?php else:?>
                    <button type="submit" class="btn btn-success" name="save">Submit</button>
                    <?php endif?>
                </div>
            </form>
        </div>
    </div>
</body>
</html>