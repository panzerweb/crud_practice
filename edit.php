<?php
    include("./config/db.php");

    if($_GET["item_id"]){
        $item_id = $_GET["item_id"];

        $selectQuery = "SELECT item_table.task_name, item_table.task_desc, deadline.due_date
        FROM item_table LEFT JOIN deadline ON item_table.item_id = deadline.item_id WHERE item_table.item_id = '$item_id'";

        $result = mysqli_query($conn, $selectQuery);

        if($rows = mysqli_num_rows($result)){
            while ($row = mysqli_fetch_array($result)) {
                $task_name = $row["task_name"];
                $task_desc = $row["task_desc"];
                $due_date = $row["due_date"];
            }
        }
    }

    if (isset($_POST["update"])) {
        $task_name = $_POST["taskname"];
        $task_desc = $_POST["taskdesc"];
        $due_date = $_POST["due_date"];

        $updateQuery = "UPDATE item_table SET task_name = '$task_name', task_desc = '$task_desc' WHERE item_id = '$item_id'";

        $updateDueDate = "UPDATE deadline SET due_date = '$due_date' WHERE item_id = '$item_id'";

        if (mysqli_query($conn, $updateQuery) && mysqli_query($conn, $updateDueDate)) {
            header("location: ./index.php");
        } else {
            echo "Error updating records: " . mysqli_error($conn);
        }
        
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="./assets/bootstrap-5.3.3-dist/css/bootstrap.css">
    <link rel="stylesheet" href="./assets/bootstrap-5.3.3-dist/css/bootstrap.min.css">
</head>
<body>
    
    <div class="container-lg">
        <form action="" method="POST">
            <div class="row mb-3">
                <label for="taskname" class="col-sm-2 col-form-label">Task</label>
                <div class="col-sm-12">
                <input type="text" class="form-control" id="taskname" name="taskname" value="<?php echo $task_name ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="taskdesc" class="form-label">Description</label>
                <div class="col-sm-12">
                    <textarea class="form-control" id="taskdesc" rows="3" name="taskdesc">
                        <?php echo $task_desc?>
                    </textarea>
                </div>
            </div>
            <div class="row mb-3">
                <label for="due_date" class="form-label">Deadline</label>
                <div class="col-sm-12">
                    <input type="date" class="form-control" id="due_date" name="due_date" value="<?php echo $due_date ?>">
                </div>
            </div>
            <button type="submit" name="update" class="btn btn-success">Update</button>
        </form>
    </div>

    <script src="./assets/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
    <script src="./assets/bootstrap-5.3.3-dist/js/bootstrap.min.js"></script>
</body>
</html>