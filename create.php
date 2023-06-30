<?php
/** @var mysqli $db */

require_once "includes/database.php";

//Get the result set from the database with a SQL query
$query = "SELECT * FROM treatments";
$result = mysqli_query($db, $query) or die ('Error: ' . $query );

//Loop through the result to create custom array
$treatments = [];
while ($row = mysqli_fetch_assoc($result)) {
    $treatments[] = $row;
}

//Check if Post isset, else do nothing
if (isset($_POST['submit'])) {
    //Require database in this file & image helpers
    require_once "includes/database.php";

    //Postback with the data showed to the user, first retrieve data from 'Super global'
    $name       = mysqli_escape_string($db, $_POST['name']);
    $treatment_id = mysqli_escape_string($db, $_POST['treatment-id']);
    $email      = mysqli_escape_string($db, $_POST['email']);
    $telephone  = mysqli_escape_string($db, $_POST['telephone']);
    $time       = mysqli_escape_string($db, $_POST['time']);
    $date       = mysqli_escape_string($db, $_POST['date']);

    //Require the form validation handling
    require_once "includes/form-validation.php";

    if (empty($errors)) {
        //Save the record to the database
        $query = "INSERT INTO reservations (treatment_id, name, email, telephone, time, date)
                  VALUES ('$treatment_id', '$name', '$email', '$telephone', '$time', '$date')";
        //echo $query;
        $result = mysqli_query($db, $query) or die('Error: '.mysqli_error($db). ' with query ' . $query);

        //Close connection
        mysqli_close($db);

        // Redirect to index.php
        header('Location: home.php');
        exit;
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <title>Albatros Barbershop</title>
</head>
<body>
<header>

</header>
<main>
    <h1>Albatros Barbershop</h1>
    <p>Hier kunt u een afspraak maken.</p>
    <section class="form-box">
        <form action="" method="post">
            <div class="form-element">
                <label for="name">Naam</label><br>
                <input id="name" type="text" name="name" placeholder="Vul uw naam in" value="<?= $name ?? '' ?><?= isset($name) ? htmlentities($name) : '' ?>"><br>
                <p class="help is-danger">
                    <?= $errors['name'] ?? '' ?>
                </p>
            </div>
            <div class="form-element">
                <label for="email">E-mail</label><br>
                <input id="email" type="text" name="email" placeholder="Vul uw email in" value="<?= isset($email) ? htmlentities($email) : '' ?><?= $email ?? '' ?>"><br>
                <p class="help is-danger">
                    <?= $errors['email'] ?? '' ?>
                </p>
            </div>
            <div class="form-element">
                <label for="telephone">Telefoon</label><br>
                <input id="telephone" type="text" name="telephone" placeholder="Vul uw telefoonnumer in" value="<?= isset($telephone) ? htmlentities($telephone) : '' ?><?= $telephone ?? '' ?>"><br>
            </div>
            <div class="form-element">
                <label for="time">Tijd</label><br>
                <input id="time" type="time" name="time" placeholder="Vul de tijd in" value="<?= isset($time) ? htmlentities($time) : '' ?><?= $time ?? '' ?>"><br>
                <p class="help is-danger">
                    <?= $errors['time'] ?? '' ?>
                </p>
            </div>
            <div class="form-element">
                <label for="date">Datum</label><br>
                <input id="date" type="date" name="date" placeholder="Vul de datum in" value="<?= isset($date) ? htmlentities($date) : '' ?><?= $date ?? '' ?>"><br>
                <p class="help is-danger">
                    <?= $errors['date'] ?? '' ?>
                </p>
            </div>
            <div class="form-element">
                <label for="treatment-id">Behandeling</label><br>
                <select id="treatment-id" name="treatment-id" placeholder="Vul de behandeling in" value="<?= isset($treatment) ? htmlentities($treatment) : '' ?><?= $treatment ?? '' ?>"><br>
                    <?php foreach ($treatments as $treatment) { ?>
                        <option value="<?= $treatment['treatment_id'] ?>"><?= $treatment['kind']?></option>
                    <?php } ?>
                </select>
                <p class="help is-danger">
                    <?= $errors['treatment_id'] ?? '' ?>
                </p>
            </div>
            <div>
                <button type="submit" name="submit">Versturen</button>
            </div>
        </form>
    </section>
</main>
</body>
</html>