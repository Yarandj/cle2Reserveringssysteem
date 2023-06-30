<?php
session_start();
/** @var mysqli $db */

//May I even visit this page?
if (!isset($_SESSION['loggedInUser'])) {
    header("Location: login.php");
    exit;
}

$name = $_SESSION['loggedInUser']['name'];

// redirect when uri does not contain an id
if(!isset($_GET['id']) || $_GET['id'] == '') {
    // redirect to index.php
    header('Location: index.php');
    exit;
}

//Require database in this file
require_once "includes/database.php";

//Retrieve the GET parameter from the 'Super global'
$reservationId = mysqli_escape_string($db, $_GET['id']);

//Get the record from the database result
$query = "SELECT reservations.id, reservations.name, reservations.email, reservations.telephone, reservations.time, reservations.date, treatments.treatment_id, treatments.kind FROM reservations INNER JOIN treatments ON reservations.treatment_id = treatments.treatment_id WHERE id = '$reservationId'";
$result = mysqli_query($db, $query)
or die ('Error: ' . $query );

if(mysqli_num_rows($result) != 1)
{
    // redirect when db returns no result
    header('Location: index.php');
    exit;
}

$reservation = mysqli_fetch_assoc($result);

//Close connection
mysqli_close($db);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Afspraak - Details</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
</head>
<body>
<div class="container px-4">
    <h1 class="title mt-4"><?= $reservation['name'] ?></h1>
    <section class="content">
        <ul>
            <li>E-mail: <?= $reservation['email'] ?></li>
            <li>Telefoon: <?= $reservation['telephone'] ?></li>
            <li>Tijd: <?= $reservation['time'] ?></li>
            <li>Datum: <?= $reservation['date'] ?></li>
            <li>Behandeling: <?= $reservation['kind'] ?></li>
        </ul>
        <a class="button" href="index.php">Ga terug naar overzicht</a>
    </section>
</div>
</body>
</html>
