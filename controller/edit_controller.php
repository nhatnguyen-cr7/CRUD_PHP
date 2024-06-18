<?php
require_once '../model/StudentModel.php';
require_once '../config/database.php';

$studentModel = new StudentModel($connection);

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $student = $studentModel->getStudentById($id);

    if ($student) {
        $name = $student['name'];
        $address = $student['address'];
        $phone = $student['phone'];
    } else {
        header("Location: ../view/index.php?status=record_not_found");
        exit();
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $id = intval($_POST['id']);
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];

    $result = $studentModel->updateStudent($id, $name, $address, $phone);

    if ($result) {
        header("Location: ../view/index.php?status=update_success");
        exit();
    } else {
        header("Location: ../view/edit.php?id=$id&status=update_error&message=" . mysqli_error($connection));
        exit();
    }
}

mysqli_close($connection);
?>
