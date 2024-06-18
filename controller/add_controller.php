<?php
require_once '../model/StudentModel.php';
require_once '../config/database.php';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
   
    
    $StudentModel = new StudentModel($connection);

    $result = $StudentModel->addStudent($name, $address, $phone);

    if ($result) {
        header("Location: ../view/index.php?status=success");
        exit();
    } else {
        header("Location: ../view/add.php?status=error&message=" . mysqli_error($connection));
        exit();
    }
} else {
    header("Location: ../view/add.php");
    exit();
}
?>
