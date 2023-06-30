<?php
require_once "includes/database.php";

if (isset($_GET['id']) && isset($_POST['editForm'])){
    $id = $_GET['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $time = $_POST['time'];
    $date = $_POST['date'];
    $treatment = $_POST['treatment'];

    $sql = "UPDATE `reservations` SET 
            `name`= '$name',
            `email`= '$email',
            `telephone`= '$telephone',
            `time`= '$time',
            `date`= '$date',
            `treatment`= '$treatment' 
            WHERE id = $id";
    /**if ($con->query($sql) === TRUE){
        echo "Modified to the data";
    } else {
        echo "Something went wrong";
    }*/
} else {
    echo "invalid";
}
?>