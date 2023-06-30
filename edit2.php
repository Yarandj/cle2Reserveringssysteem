<?php
/** @var mysqli $db */

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
$query = "UPDATE reservations SET name, email, telephone, time, date, treatment
                  VALUES ('$name', '$email', '$telephone', '$time', '$date', '$treatment')";
echo $query;
$result = mysqli_query($db, $query) or die('Error: '.mysqli_error($db). ' with query ' . $query);

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
    <section class="form-box">
        <form action="" method="post">
            <div class="form-element">
                <label for="name">Naam</label><br>
                <input id="name" type="text" name="name" value="<?= $reservation['name'] ?>"><br>
                <p class="help is-danger">
                    <?= $errors['name'] ?? '' ?>
                </p>
            </div>
            <div class="form-element">
                <label for="email">E-mail</label><br>
                <input id="email" type="text" name="email" value="<?= $reservation['email'] ?>"><br>
                <p class="help is-danger">
                    <?= $errors['email'] ?? '' ?>
                </p>
            </div>
            <div class="form-element">
                <label for="telephone">Telefoon</label><br>
                <input id="telephone" type="text" name="telephone" value="<?= $reservation['telephone'] ?>"><br>
            </div>
            <div class="form-element">
                <label for="time">Tijd</label><br>
                <input id="time" type="time" name="time" value="<?= $reservation['time'] ?>"><br>
                <p class="help is-danger">
                    <?= $errors['time'] ?? '' ?>
                </p>
            </div>
            <div class="form-element">
                <label for="date">Datum</label><br>
                <input id="date" type="date" name="date" value="<?= $reservation['date'] ?>" <br>
                <p class="help is-danger">
                    <?= $errors['date'] ?? '' ?>
                </p>
            </div>
            <div class="form-element">
                <label for="treatment">Behandeling</label><br>
                <input id="treatment" type="text" name="treatment" value="<?= $reservation['treatment'] ?>" <br>
            </div>
            <div>
                <button type="submit" name="submit">Versturen</button>
            </div>
        </form>
    </section>
    <a class="button" href="index.php">Ga terug naar overzicht</a>
    </section>
</div>
</body>
</html>
