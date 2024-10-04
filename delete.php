<?php
    include("./config/db.php");

    if(isset($_GET["item_id"])){
        $item_id = $_GET["item_id"];

        $deleteQuery = "DELETE FROM item_table WHERE item_id = '$item_id'";
        $result = mysqli_query($conn, $deleteQuery);

        if ($result) {
            header("location: ./index.php");
        } else {
            echo "Error:" . $sql . "<br>" . $conn->error;
        }
        
    }
?>