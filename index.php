<?php
session_start();
/** @var mysqli $db */
/** @var $reservationId */
//Require DB settings with connection variable
require_once 'includes/database.php';

//May I even visit this page?
if (!isset($_SESSION['loggedInUser'])) {
    header("Location: login.php");
    exit;
}

$name = $_SESSION['loggedInUser']['name'];

//Get the result set from the database with a SQL query
$query = "SELECT reservations.id, reservations.name, reservations.email, reservations.telephone, reservations.time, reservations.date, treatments.treatment_id, treatments.kind FROM treatments INNER JOIN reservations ON treatments.treatment_id = reservations.treatment_id";
$result = mysqli_query($db, $query) or die ('Error: ' . $query );

//Loop through the result to create a custom array
$reservations = [];
while ($row = mysqli_fetch_assoc($result)) {
    $reservations[] = $row;
}

//Close connection
mysqli_close($db);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reserveringen</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
</head>
<body>
<div class="container px-4">
    <h1 class="title mt-4">Gemaakte afspraken</h1>
    <hr/>
    <table class="table is-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Naam</th>
            <th>E-mail</th>
            <th>Telefoon</th>
            <th>Tijd</th>
            <th>Datum</th>
            <th>Behandeling</th>
            <th>Details</th>
            <th>Wijzigen</th>
            <th>Verwijderen</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <td colspan="10" class="has-text-centered">&copy; Albatros Barbershop</td>
        </tr>
        </tfoot>
        <tbody>
        <?php foreach ($reservations as $index => $reservation) { ?>
            <tr>
                <td><?= $index + 1 ?></td>
                <td><?= $reservation['name'] ?></td>
                <td><?= $reservation['email'] ?></td>
                <td><?= $reservation['telephone'] ?></td>
                <td><?= $reservation['time'] ?></td>
                <td><?= $reservation['date'] ?></td>
                <td><?= $reservation['kind'] ?></td>
                <td><a href="details.php?id=<?= $reservation['id'] ?>">Details</a></td>
                <td><a href="update.php?id=<?= $reservation['id'] ?>">Wijzigen</a></td>
                <td><a href="delete.php?id=<?= $reservation['id'] ?>">Verwijderen</a></td>
                <input type="hidden" name="id" value="<?= $reservationId ?>">
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
<section class="">
    <button class="button"><a href="create.php">Maak een afspraak!</a></button>
</section>
<section class="">
    <button class="button"><a href="logout.php">Log uit</a></button>
</section>
</body>
</html>