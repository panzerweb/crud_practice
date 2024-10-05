<?php
    include("./config/db.php");

    //When submit is clicked, then retrieve the values and insert into query
    if (isset($_POST["submit"])) {
        $task_name = mysqli_real_escape_string($conn, $_POST["taskname"]);
        $task_desc = mysqli_real_escape_string($conn, $_POST["taskdesc"]);
        $due_date = $_POST["due_date"];
        $date = date("Y-m-d H:i:s"); //This is a date format only, not for due_date
        
        //Insert the following input into item_table
        $insertQuery = "INSERT INTO `item_table` (task_name, task_desc, created_at) VALUES('$task_name', '$task_desc', '$date')";

        $result = mysqli_query($conn, $insertQuery);

        //If the insertion is true, we'll insert the due_date's value into the deadline table
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