<?php
require_once '../model/StudentModel.php';
require_once '../config/database.php';

$studentModel = new StudentModel($connection);

$students = [];
$search_query = '';

if (isset($_GET['search'])) {
    $search_query = $_GET['search'];
    $students = $studentModel->searchStudents($search_query);
    
    
} else {
    $students = $studentModel->getAllStudents();
    
}

mysqli_close($connection);
?>
