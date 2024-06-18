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
                        <button class="btn btn-success">
                            <a href="add.php" class="text-light">Add New</a>
                        </button>
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
                                require_once '../model/StudentModel.php';
                                require_once '../config/database.php';

                                $studentModel = new StudentModel($connection);
                                $result = $studentModel->getAllStudents();

                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<tr>";
                                        echo "<th scope='row'>" . $row['id'] . "</th>";
                                        echo "<td>" . $row['name'] . "</td>";
                                        echo "<td>" . $row['address'] . "</td>";
                                        echo "<td>" . $row['phone'] . "</td>";
                                        echo "<td>";
                                        echo "<a href='edit.php?id=" . $row['id'] . "' class='btn btn-primary btn-sm'>Edit</a>&nbsp;";
                                        echo "<a href='../controller/delete_controller.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm'>Delete</a>";
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='5'>No records found</td></tr>";
                                }

                                mysqli_close($connection);
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
