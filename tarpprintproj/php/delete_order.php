<?php
    include "db_con.php";
    $orderID = $_GET['orderID'];
    $sql = "DELETE FROM orders WHERE orderID = $orderID";
    $result = mysqli_query($conn, $sql);
    if($result) {
        header("Location: admin1.php?msg=Order deleted successfully");
    }
    else {
        echo "Failed: " . mysqli_error($conn);
    }
?>