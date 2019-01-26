<?php

session_start();

$update = false;
$id = 0;
$name = '';
$location = '';

$mysqli = new mysqli('list', 'root', '', 'list') or die(mysqli_error($mysqli));

    if(isset($_POST['save'])){

        $name = $_POST['name'];
        $location = $_POST['location'];

        $_SESSION['message'] = 'Record has been saved!';
        $_SESSION['msg_type'] = 'success';

        $mysqli->query("INSERT INTO data(name, location) VALUES('$name', '$location')") or
            die($mysqli->error);

        header('location: index.php');
    }

    if(isset($_GET['delete'])){

        $id = $_GET['delete'];

        $_SESSION['message'] = 'Record has been deleted!';
        $_SESSION['msg_type'] = 'danger';

        $mysqli->query("DELETE FROM data WHERE id=$id") or die($mysqli->error);

        header('location: index.php');
    }

    if(isset($_GET['edit'])){
        $id = $_GET['edit'];

        $result = $mysqli->query("SELECT * FROM data WHERE id=$id") or die($mysqli->error);

        $row = $result->fetch_array();
        $update = true;
        $name = $row['name'];
        $location = $row['location'];
    }

    if(isset($_POST['update'])){
        $id = $_POST['id'];
        $name = $_POST['name'];
        $location = $_POST['location'];

        $mysqli->query("UPDATE data SET name='$name', location='$location' WHERE id=$id") or die($mysqli->error);

        $_SESSION['message'] = 'Record has been updated!';
        $_SESSION['type'] = 'warning';

        header('location: index.php');
    }