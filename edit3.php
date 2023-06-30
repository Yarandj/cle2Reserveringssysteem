<?php
/** @var mysqli $db */
if(!isset($_GET['id'])) {
    die('id not provided');
}
require_once "includes/database.php";
$id = $_GET['id'];
$sql = "SELECT * FROM `reservations` where id = $id";
$result = mysqli_query($db, $sql) or die('Error: '.mysqli_error($db). ' with query ' . $sql);
if($result->num_rows != 1) {
    die('id not provided');
}
$data = $result->fetch_assoc();

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
        <form action="./modify.php?id=<?= $id ?>" method="post">
            <div class="form-element">
                <label for="name">Naam</label><br>
                <input id="name" type="text" name="name" placeholder="Vul uw naam in" value="<?= $data['name']?>"><br>
                <p class="help is-danger">
                    <?= $errors['name'] ?? '' ?>
                </p>
            </div>
            <div class="form-element">
                <label for="email">E-mail</label><br>
                <input id="email" type="text" name="email" placeholder="Vul uw email in" value="<?= $data['email']?>"><br>
                <p class="help is-danger">
                    <?= $errors['email'] ?? '' ?>
                </p>
            </div>
            <div class="form-element">
                <label for="telephone">Telefoon</label><br>
                <input id="telephone" type="text" name="telephone" placeholder="Vul uw telefoonnumer in" value="<?= $data['telephone']?>"><br>
            </div>
            <div class="form-element">
                <label for="time">Tijd</label><br>
                <input id="time" type="time" name="time" placeholder="Vul de tijd in" value="<?= $data['time']?>"><br>
                <p class="help is-danger">
                    <?= $errors['time'] ?? '' ?>
                </p>
            </div>
            <div class="form-element">
                <label for="date">Datum</label><br>
                <input id="date" type="date" name="date" placeholder="Vul de datum in" value="<?= $data['date']?>"><br>
                <p class="help is-danger">
                    <?= $errors['date'] ?? '' ?>
                </p>
            </div>
            <div class="form-element">
                <label for="treatment">Behandeling</label><br>
                <input id="treatment" type="text" name="treatment" placeholder="Vul de behandeling in" value="<?= $data['treatment']?>"><br>
            </div>
            <div>
                <button type="submit" name="editForm" value="submit">Versturen</button>
            </div>
        </form>
    </section>
</main>
</body>
</html>