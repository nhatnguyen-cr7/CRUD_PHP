<?php
require_once '../model/StudentModel.php';
require_once '../config/database.php';

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];

    $studentModel = new StudentModel($connection);

    $result = $studentModel->updateStudent($id, $name, $address, $phone);

    if ($result) {
        header("Location: ../view/index.php?status=update_success");
        exit();
    } else {
        header("Location: ../view/edit.php?id=$id&status=update_error&message=" . mysqli_error($connection));
        exit();
    }

    mysqli_close($connection);
} else {
    $id = $_GET['id'];
    header("Location: ../view/edit.php?id=$id");
    exit();
}
?>
