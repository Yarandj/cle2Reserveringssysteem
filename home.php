<?php
/** @var mysqli $db */
/** @var $reservationId */
//Require DB settings with connection variable
require_once 'includes/database.php';

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
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Albatros Barbershop - Home</title>
    <link rel="stylesheet" href="css/mystyle.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
</head>
<body>

<header>
    <section class="hero is-black">
        <div class="hero-body">
            <p class="title">
            Albatros Barbershop
            </p>
            <p class="subtitle">
            </p>
        </div>
        <div id="navbarMenuHeroA" class="navbar-menu">
            <div class="navbar-end">
                <a class="navbar-item is-active">

                </a>
                <a class="navbar-item">

                </a>
                <a class="navbar-item">

                </a>
                <span class="navbar-item">
              <a href="login.php" class="button is-primary is-inverted">
                <span class="icon">
                  <i class="fab fa-github"></i>
                </span>
                <span>Login</span>
              </a>
            </span>
            </div>
        </div>
    </section>
    <nav>
        <ul class="navigation-bar">
            <li><a class="menu-link" href="home.html">Home</a></li>
            <li><a class="menu-link" href="create.php">Afspraak maken</a></li>
            <li style="float:right"><a class="menu-link2" href="login.php">Login</a></li>
        </ul>
    </nav>
</header>
<main>
    <a href="create.php">Maak een afspraak!</a>
    <a href="details.php?id=''">Mijn afspraak bekijken</a>
    <a href="update.php">Mijn afsrpaak wijzigen</a>
    <a href="delete.php">Mijn afspraak verwijderen</a>

    <div class="tile is-ancestor">
        <div class="tile is-8 is-vertical is-parent">
            <div class="tile is-child box">
                <p class="title">Welkom bij Albatros Barbershop</p>
            </div>
        </div>
        <div class="tile is-parent">
            <div class="tile is-child box">
                <p class="title">Openingstijden</p>
                <table class="table is-striped">
                    <thead>
                    <tr>
                        <th>Dag</th>
                        <th>Tijden</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <td colspan="2" class="has-text-centered">&copy; Albatros Barbershop</td>
                    </tr>
                    </tfoot>
                    <tbody>
                        <tr>
                            <td>Maandag</td>
                            <td>09:00 - 19:00</td>
                        </tr>
                    </tbody>
                    <tbody>
                    <tr>
                        <td>Dinsdag</td>
                        <td>09:00 - 19:00</td>
                    </tr>
                    </tbody>
                    <tbody>
                    <tr>
                        <td>Woensdag</td>
                        <td>09:00 - 19:00</td>
                    </tr>
                    </tbody>
                    <tbody>
                    <tr>
                        <td>Donderdag</td>
                        <td>09:00 - 19:00</td>
                    </tr>
                    </tbody>
                    <tbody>
                    <tr>
                        <td>Vrijdag</td>
                        <td>09:00 - 20:00</td>
                    </tr>
                    </tbody>
                    <tbody>
                    <tr>
                        <td>Zaterdag</td>
                        <td>09:00 - 18:00</td>
                    </tr>
                    </tbody>
                    <tbody>
                    <tr>
                        <td>Zondag</td>
                        <td>Gesloten</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
<footer>
    <span>&copy; Albatros Barbershop</span>
</footer>
</body>
</html>