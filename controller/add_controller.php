<?php
require_once '../config/database.php';
require_once '../model/StudentModel.php';

$studentModel = new StudentModel($connection);

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];


    $errors = [];

    if (empty($name)) {
        $errors[] = "Name must be filled out.";
    } elseif (strlen($name) > 100) {
        $errors[] = "Name must not exceed 100 characters.";
    }

    if (empty($address)) {
        $errors[] = "Address must be filled out.";
    } elseif (strlen($address) > 255) {
        $errors[] = "Address must not exceed 255 characters.";
    }

    if (empty($phone)) {
        $errors[] = "Phone must be filled out.";
    } elseif (!preg_match('/^\+?\d{8,15}$/', $phone)) {
        $errors[] = "Phone number format is invalid.";
    }

    if (!empty($errors)) {
        $error_message = implode("<br>", $errors);
        header("Location: ../view/add.php?status=error&message=" . urlencode($error_message));
        exit();
    }

    try {
        if ($studentModel->addStudent($name, $address, $phone)) {
            header("Location: ../view/index.php?status=success");
            exit();
        } else {
            header("Location: ../view/add.php?status=error&message=" . urlencode("Failed to add student."));
            exit();
        }
    } catch (Exception $e) {
        header("Location: ../view/add.php?status=error&message=" . urlencode($e->getMessage()));
        exit();
    }
} else {
    header("Location: ../view/add.php");
    exit();
}
?>
