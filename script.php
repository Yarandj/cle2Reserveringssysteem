<?php
session_start();
/** @var mysqli $db */

//Require DB settings with connection variable
require_once "includes/database.php";


/*May I even visit this page?
if (!isset($_SESSION['loggedInUser'])) {
    header("Location: login.php");
    exit;
}

**///Get email from session
//$name = $_SESSION['loggedInUser']['name'];

if(isset($_POST['delete']))
{
    $reservationId = mysqli_real_escape_string($db, $_POST['reservationId']);

    $query = "DELETE FROM reservations WHERE id='$reservationId' ";
    $query_run = mysqli_query($db, $query);

    if($query_run)
    {
        $_SESSION['message'] = "employee Deleted Successfully";
        header("Location: index.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "employee Not Deleted";
        header("Location: index.php");
        exit(0);
    }
}

if(isset($_POST['update']))
{
    $reservationId = mysqli_real_escape_string($db, $_POST['reservationId']);

    $name   = mysqli_escape_string($db, $_POST['name']);
    $treatment_id = mysqli_escape_string($db, $_POST['treatment-id']);
    $email   = mysqli_escape_string($db, $_POST['email']);
    $telephone  = mysqli_escape_string($db, $_POST['telephone']);
    $time   = mysqli_escape_string($db, $_POST['time']);
    $date = mysqli_real_escape_string($db, $_POST['date']);

    $query = "UPDATE reservations SET name='$name', treatment_id ='$treatment_id', email='$email', telephone='$telephone', time='$time', date='$date' WHERE id='$reservationId' ";
    $query_run = mysqli_query($db, $query);

    if($query_run)
    {
        $_SESSION['message'] = "employee Updated Successfully";
        header("Location: index.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "employee Not Updated";
        header("Location: update.php");
        exit(0);
    }

}
