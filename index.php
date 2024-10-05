<?php
    include("./config/db.php");

    //Select the specific columns we want from the connected tables
    $selectQuery = "
                    SELECT i.item_id, i.task_name, i.task_desc, i.created_at, i.is_favorite, d.due_date
                    FROM item_table i
                    LEFT JOIN deadline d ON i.item_id = d.item_id;
                    ";
    $result = mysqli_query( $conn, $selectQuery );

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="./assets/bootstrap-5.3.3-dist/css/bootstrap.css">
    <link rel="stylesheet" href="./assets/bootstrap-5.3.3-dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container-lg">
        <form action="./add.php" method="post">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-danger m-5" data-bs-toggle="modal" data-bs-target="#addingModal">
            Launch demo modal
            </button>

            <!-- Modal -->
            <div class="modal fade" id="addingModal" tabindex="-1" aria-labelledby="addingModalExample" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="addingModalExample">Modal title</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <form>
                        <div class="row mb-3">
                            <label for="taskname" class="col-sm-2 col-form-label">Task</label>
                            <div class="col-sm-12">
                            <input type="text" class="form-control" id="taskname" name="taskname">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="taskdesc" class="form-label">Description</label>
                            <div class="col-sm-12">
                                <textarea class="form-control" id="taskdesc" rows="3" name="taskdesc"></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="due_date" class="form-label">Deadline</label>
                            <div class="col-sm-12">
                                <input type="date" class="form-control" id="due_date" name="due_date">
                            </div>
                        </div>
                    </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="submit">Add Task</button>
                    </div>
                    </div>
                </div>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                    <th>Task Name</th>
                    <th>Task Description</th>
                    <th>Due Date</th>
                    <th>Action</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php if($rows = mysqli_num_rows($result) > 0){ ?>
                    <?php while($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row["task_name"]); ?></td>
                        <td><?php echo htmlspecialchars($row["task_desc"]); ?></td>
                        <td><?php echo htmlspecialchars($row["due_date"]); ?></td>
                        <td>
                            <?php
                                echo '<a href="./edit.php?item_id=' . $row['item_id'] . '" class="btn btn-success">Edit</a>'
                            ?>
                            <?php
                                echo '<a href="./delete.php?item_id=' . $row['item_id'] . '" class="btn btn-danger">Delete</a>'
                            ?>
                            <?php 
                                //Check if the task is marked as favorite
                                $starredIcon = $row["is_favorite"] ? 'bi-star-fill' : 'bi-star';
                                
                                //When clicked, output with the appropriate icon
                                echo '<a href="./starred.php?item_id=' . $row['item_id'] . '" class="btn btn-outline-dark">
                                    <i class= "bi ' . $starredIcon . ' fs-6" ></i>
                                </a>'
                            ?>
                        </td>
                    </tr>
                    <?php }
                    
                    }else{?>

                        <td colspan="4">No Record Found</td>
                        
                    <?php }?>
                </tbody>
            </table>
        </div>


    </div>

    <script src="./assets/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
    <script src="./assets/bootstrap-5.3.3-dist/js/bootstrap.min.js"></script>
</body>
</html>