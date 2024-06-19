<?php
require_once '../controller/page_controller.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<body>
    <div class="container">
        <div class="row justify-content-center mt-5">
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
                                    <th scope="col">
                                        <a href="?sort=id&order=<?php echo ($sort === 'id' && $order === 'asc') ? 'desc' : 'asc'; ?>&search=<?php echo htmlspecialchars($search_query); ?>" class="text-dark">
                                            ID <?php if ($sort === 'id') { ?>
                                                <?php if ($order === 'asc') { ?>
                                                    <i class="bi bi-arrow-down"></i>
                                                <?php } else { ?>
                                                    <i class="bi bi-arrow-up"></i>
                                                <?php } ?>
                                            <?php } ?>
                                        </a>
                                    </th>
                                    <th scope="col">
                                        <a href="?sort=name&order=<?php echo ($sort === 'name' && $order === 'asc') ? 'desc' : 'asc'; ?>&search=<?php echo htmlspecialchars($search_query); ?>" class="text-dark">
                                            Name <?php if ($sort === 'name') { ?>
                                                <?php if ($order === 'asc') { ?>
                                                    <i class="bi bi-arrow-down"></i>
                                                <?php } else { ?>
                                                    <i class="bi bi-arrow-up"></i>
                                                <?php } ?>
                                            <?php } ?>
                                        </a>
                                    </th>
                                    <th scope="col">
                                        <a href="?sort=address&order=<?php echo ($sort === 'address' && $order === 'asc') ? 'desc' : 'asc'; ?>&search=<?php echo htmlspecialchars($search_query); ?>" class="text-dark">
                                            Address <?php if ($sort === 'address') { ?>
                                                <?php if ($order === 'asc') { ?>
                                                    <i class="bi bi-arrow-down"></i>
                                                <?php } else { ?>
                                                    <i class="bi bi-arrow-up"></i>
                                                <?php } ?>
                                            <?php } ?>
                                        </a>
                                    </th>
                                    <th scope="col">
                                        <a href="?sort=phone&order=<?php echo ($sort === 'phone' && $order === 'asc') ? 'desc' : 'asc'; ?>&search=<?php echo htmlspecialchars($search_query); ?>" class="text-dark">
                                            Phone <?php if ($sort === 'phone') { ?>
                                                <?php if ($order === 'asc') { ?>
                                                    <i class="bi bi-arrow-down"></i>
                                                <?php } else { ?>
                                                    <i class="bi bi-arrow-up"></i>
                                                <?php } ?>
                                            <?php } ?>
                                        </a>
                                    </th>
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
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-center">
                                <li class="page-item <?php echo ($page <= 1) ? 'disabled' : ''; ?>">
                                    <a class="page-link" href="<?php echo ($page <= 1 && !isset($_GET['search'])) ? '#' : '?page=' . ($page - 1) . '&sort=' . $sort . '&order=' . $order . '&search=' . htmlspecialchars($search_query); ?>" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                    <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                                        <a class="page-link" href="?page=<?php echo $i; ?>&sort=<?php echo $sort; ?>&order=<?php echo $order; ?>&search=<?php echo htmlspecialchars($search_query); ?>"><?php echo $i; ?></a>
                                    </li>
                                <?php endfor; ?>
                                <li class="page-item <?php echo ($page >= $total_pages) ? 'disabled' : ''; ?>">
                                    <a class="page-link" href="<?php echo ($page >= $total_pages && !isset($_GET['search'])) ? '#' : '?page=' . ($page + 1) . '&sort=' . $sort . '&order=' . $order . '&search=' . htmlspecialchars($search_query); ?>" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>

                        </nav>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
