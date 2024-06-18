<?php
require_once '../controller/search_controller.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h1>CRUD Student</h1>
                    </div>
                    <div class="card-body">
                        <form action="" method="" class="d-flex mb-3">
                            <input type="text" name="search" class="form-control me-2" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>" placeholder="Search students">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </form>
                        <a href="add.php" class="btn btn-success text-light">Add New</a>
                        <br><br>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                if (!empty($students)) {
                                    foreach ($students as $row) {
                                        echo "<tr>";
                                        echo "<th scope='row'>" . htmlspecialchars($row['id']) . "</th>";
                                        echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['address']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['phone']) . "</td>";
                                        echo "<td>";
                                        echo "<a href='edit.php?id=" . htmlspecialchars($row['id']) . "' class='btn btn-primary btn-sm'>Edit</a>&nbsp;";
                                        echo "<a href='../controller/delete_controller.php?id=" . htmlspecialchars($row['id']) . "' class='btn btn-danger btn-sm'>Delete</a>";
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='5'>No records found</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
