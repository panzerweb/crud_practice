<?php
    include("./config/db.php");

    if (isset($_POST["submit"])) {
        $task_name = mysqli_real_escape_string($conn, $_POST["taskname"]);
        $task_desc = mysqli_real_escape_string($conn, $_POST["taskdesc"]);
        $due_date = $_POST["due_date"];
        $date = date("Y-m-d H:i:s");
        
        $insertQuery = "INSERT INTO `item_table` (task_name, task_desc, created_at) VALUES('$task_name', '$task_desc', '$date')";

        $result = mysqli_query($conn, $insertQuery);

        if($result == true){
            $item_id = mysqli_insert_id($conn);

            $insertDueDate = "INSERT INTO `deadline` (item_id, due_date) VALUES ('$item_id', '$due_date')";

            $resultDate = mysqli_query($conn, $insertDueDate);

            if($resultDate == true){
                header("location: ./index.php");
            }
            else{
                echo "Error: " . $insertQuery . "<br>" . $conn->error;
            }
        }
        else{
            echo "Error: " . $insertQuery . "<br>" . $conn->error;
        }

    }

?>