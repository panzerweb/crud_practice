<?php
// The mysql code to add the is_favorite column
//  ALTER TABLE table_name task_table ADD COLUMN is_favorite TINYINT(1) DEFAULT 0;

    include("./config/db.php");

    //Retrieve the item_id
    $item_id = $_GET["item_id"];

    //Select the column from item_table where it matches with the item_id
    $selectQuery = "SELECT is_favorite FROM item_table WHERE item_id = '$item_id'";
    $result = mysqli_query($conn, $selectQuery);
    $row = mysqli_fetch_assoc($result);

    //Toggle the icon
    $fav_value = $row["is_favorite"] == 1 ? 0:1;

    //Update the is_favorite to match to the fav_value where item_id is match
    $updateFav = "UPDATE item_table SET is_favorite = '$fav_value' WHERE item_id = '$item_id'";
    $updateResult = mysqli_query($conn, $updateFav);
        if ($updateResult) {
            header("location: ./index.php");
        }
        else{
            echo "Error";
        }
?>