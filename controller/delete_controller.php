<?php
require_once '../model/StudentModel.php';
require_once '../config/database.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    
    $studentModel = new StudentModel($connection);

    $result = $studentModel->deleteStudent($id);

    if ($result) {
        $reset_auto_increment_query = "ALTER TABLE students AUTO_INCREMENT = 1";
        mysqli_query($connection, $reset_auto_increment_query);

        header("Location: ../view/index.php?status=delete_success");
        exit();
    } else {
        header("Location: ../view/index.php?status=delete_error&message=" . mysqli_error($connection));
        exit();
    }
} else {
    header("Location: ../view/index.php");
    exit();
}

mysqli_close($connection);
?>
