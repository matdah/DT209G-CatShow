<?php include("includes/config.php"); ?>
<!DOCTYPE html>
<html lang="sv">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Milligram CSS -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.4.1/milligram.css">
    <title>Kattutställning</title>
</head>

<body>
    <div class="container">
        <h1>Kattutställning</h1>

        <?php
        $contestant = new Contestant();

        // Kontrollera om formuläret är postat
        if (isset($_POST['name'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $catname = $_POST['catname'];
            $breed = $_POST['breed'];

            if ($contestant->addParticipant($name, $email, $catname, $breed)) {
                echo "<p>Du är anmäld till tävlingen!</p>";
            } else {
                echo "<p>Fel vid anmälan - fyll i samtliga fält med korrekt data!</p>";
            }
        }
        ?>

        <form method="post" action="index.php">
            <label for="name">Namn:</label>
            <input type="text" id="name" name="name">

            <label for="email">Epost:</label>
            <input type="email" id="email" name="email">

            <label for="catname">Kattnamn:</label>
            <input type="text" id="catname" name="catname">

            <label for="breed">Ras:</label>
            <input type="text" id="breed" name="breed">

            <input type="submit" value="Anmäl mig">
        </form>
    </div>
</body>

</html>