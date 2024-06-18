<?php
include '../config/database.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "SELECT * FROM students WHERE id = $id";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $name = $row['name'];
        $address = $row['address'];
        $phone = $row['phone'];
    } else {
        header("Location: index.php?status=record_not_found");
        exit();
    }

    mysqli_close($connection);
} else {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h1>Edit Student</h1>
                    </div>
                    <div class="card-body">
                        <form action="../controller/edit_controller.php" method="post">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <div class="mb-3">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control" value="<?php echo $name; ?>" placeholder="Enter Name">
                            </div>
                            <div class="mb-3">
                                <label>Address</label>
                                <input type="text" name="address" class="form-control" value="<?php echo $address; ?>" placeholder="Enter Address">
                            </div>
                            <div class="mb-3">
                                <label>Phone</label>
                                <input type="text" name="phone" class="form-control" value="<?php echo $phone; ?>" placeholder="Enter Phone">
                            </div>
                            <br>
                            <input type="submit" class="btn btn-primary" name="submit" value="Update">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
