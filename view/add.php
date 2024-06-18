<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h1>CRUD STUDENT</h1>
                    </div>
                    <div class="card-body">
                        <?php
                        if (isset($_GET['status'])) {
                            if ($_GET['status'] == 'success') {
                                echo '<div class="alert alert-success">New record created successfully</div>';
                            } else {
                                echo '<div class="alert alert-danger">Error: ' . $_GET['message'] . '</div>';
                            }
                        }
                        ?>
                        <form action="../controller/add_controller.php" method="post">
                            <div class="mb-3">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control" id="" placeholder="Enter Name">
                            </div>
                            <div class="mb-3">
                                <label>Address</label>
                                <input type="text" name="address" class="form-control" id="" placeholder="Enter Address">
                            </div>
                            <div class="mb-3">
                                <label>Phone</label>
                                <input type="text" name="phone" class="form-control" id="" placeholder="Enter Phone">
                            </div>
                            <br>
                            <input type="submit" class="btn btn-primary" name="submit" value="register">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
