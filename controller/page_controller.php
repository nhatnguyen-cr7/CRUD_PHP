<?php

require_once '../model/StudentModel.php';
require_once '../config/database.php';

$studentModel = new StudentModel($connection);

$search_query = isset($_GET['search']) ? $_GET['search'] : '';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 5;
$offset = ($page - 1) * $limit;
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'id'; 
$order = isset($_GET['order']) && $_GET['order'] === 'desc' ? 'desc' : 'asc'; 

if (!empty($search_query)) {
    $students = $studentModel->searchStudents($search_query); 
    $total_students = count($students);
    $total_pages = ceil($total_students / $limit);

    usort($students, function ($a, $b) use ($sort, $order) {
        if ($order === 'asc') {
            return $a[$sort] <=> $b[$sort];
        } else {
            return $b[$sort] <=> $a[$sort];
        }
    });

    $students = array_slice($students, $offset, $limit);
} else {
    $students = $studentModel->getStudentsByPageWithSort($limit, $offset, $sort, $order);
    $total_students = $studentModel->getTotalStudents();
    $total_pages = ceil($total_students / $limit);
}

mysqli_close($connection);
require_once '../view/index.php';
?>
