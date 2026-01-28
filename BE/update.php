<?php

include('config/config.php');

$dsn = "mysql:host=$dbHost;dbname=$dbName;charset=utf8";

$pdo = new PDO($dsn, $dbUser, $dbPass);


// Controleer of er op de submit-knop is gedrukt
if (isset($_POST['submit'])) {

   /**
 * Gaan de $_POST-waarden schoonmaken met de functie
 * filter_input_array. Deze functie filtert de waarden van een
 * array met een opgegeven filter. In dit geval: FILTER_SANITIZE_STRING
 */
$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

/**
 * Maak een insert-query die de gegevens uit het formulier in de tabel zet
 * van de database
 */
$sql = "UPDATE Rollercoaster AS HAVE
        SET RollerCoaster = :rollerCoaster
           ,AmusementPark = :amusementPark
           ,Country = :country
           ,TopSpeed = :topSpeed
           ,Height = :height
           ,YearOfConstruction = :yearOfConstruction
        WHERE HAVE.Id = :id";

/**
 * Bereidt de sql-query voor voor uitvoering in PDO
 */
$statement = $pdo->prepare($sql);

$statement->bindValue(':rollerCoaster', $_POST['naamAchtbaan'], PDO::PARAM_STR);
$statement->bindValue(':amusementPark', $_POST['naamPretpark'], PDO::PARAM_STR);
$statement->bindValue(':country', $_POST['land'], PDO::PARAM_STR);
$statement->bindValue(':topSpeed', $_POST['topsnelheid'], PDO::PARAM_INT);
$statement->bindValue(':height', $_POST['hoogte'], PDO::PARAM_INT);
$statement->bindValue(':yearOfConstruction', $_POST['bouwjaar'], PDO::PARAM_STR);
$statement->bindValue(':id', $_POST['id'], PDO::PARAM_INT);

/**
 * Voer de geprepareerde sql-query uit
 */
$statement->execute();

$display = 'flex';

header('Refresh:3; index.php');

} else {
    // We komen op de update-pagina en er is nog niet op de submit-knop gedrukt

    /**
     * Maak een select-query die alle gegevens uit de tabel
     * HoogsteAchtbaanVanEuropa haalt.
     */
    $sql = "
        SELECT
            HAVE.Id,
            HAVE.Rollercoaster,
            HAVE.AmusementPark,
            HAVE.Country,
            HAVE.Topspeed,
            HAVE.Height,
            HAVE.YearOfConstruction
        FROM Rollercoaster AS HAVE
        WHERE HAVE.Id = :id
    ";

    /**
     * Met de method prepare van het PDO-object maak je de sql-query klaar
     * om uitgevoerd te worden.
     */
    $statement = $pdo->prepare($sql);

    /**
     * Koppel de id aan de query
     */
    $statement->bindValue(':id', $_GET['id'], PDO::PARAM_INT);

    /**
     * Voer de geprepareerde sql-query uit op de database
     */
    $statement->execute();

    /**
     * Haal het geselecteerde record binnen als een object
     * en stop deze in de variabele $result
     */
    $result = $statement->fetch(PDO::FETCH_OBJ);

    // Toon de geselecteerde data uit de database
    // var_dump($result);
}
?>



<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" 
          rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" 
          crossorigin="anonymous">
</head>
<body>

    <div class="container mt-3">

    <div class="row justify-content-center">
        <div class="col-6"><h3 class="text-primary">Wijzig de achtbaangegevens</h3></div>
    </div>

    <!-- Melding naar de gebruiker dat de update is gelukt -->
<div class="row justify-content-center" style="display:<?= $display ?? 'none'; ?>">
    <div class="col-6">
        <div class="alert alert-success text-center" role="alert">
            De gegevens zijn gewijzigd. U wordt teruggestuurd naar de index-pagina.
        </div>
    </div>
</div>

    <div class="row justify-content-center">
    <div class="col-6">
        <form action="update.php" method="POST">
            <div class="mb-3">
                <label for="inputNaamAchtbaan" class="form-label">Naam Achtbaan:</label>
                <input name="naamAchtbaan" placeholder="Vul de naam van de achtbaan in" type="text" class="form-control" id="inputNaamAchtbaan"
                       value="<?= $_result->Rollercoaster ?? '' ?>">
            </div>

            <div class="mb-3">
                <label for="inputNaamPretpark" class="form-label">Naam Pretpark:</label>
                <input name="naamPretpark" placeholder="Vul de naam van de achtbaan in" type="text" class="form-control" id="inputNaamPretpark"
                       value="<?= $_result->AmusementPark ?? '' ?>">
            </div>

            <div class="mb-3">
                <label for="inputLand" class="form-label">Land:</label>
                <input name="land" placeholder="Vul de naam van het land in" type="text" class="form-control" id="inputLand"
                       value="<?= $_result->Country ?? '' ?>">
            </div>

            <div class="mb-3">
                <label for="inputTopsnelheid" class="form-label">Topsnelheid:</label>
                <input name="topsnelheid" placeholder="Vul de topsnelheid in" type="number" min="0" max="255" class="form-control" id="inputTopsnelheid"
                       value="<?= $_result->Topspeed ?? '' ?>">
            </div>

            <div class="mb-3">
                <label for="inputHoogte" class="form-label">Hoogte:</label>
                <input name="hoogte" placeholder="Vul de hoogte in" type="number" min="0" max="255" class="form-control" id="inputHoogte"
                       value="<?= $_result->Height ?? '' ?>">
            </div>

            <div class="mb-3">
                <label for="inputYearOfConstruction" class="form-label">Bouwjaar:</label>
                <input name="bouwjaar" placeholder="Vul het bouwjaar in" type="date" min="0" max="255" class="form-control" id="inputYearOfConstruction"
                       value="<?= $_result->YearOfConstruction ?? '' ?>">
            </div>

            <input name="id" type="hidden" value="<?= $result->Id?? '' ?>">

            <div class="d-grid gap-2">
                <button name="submit" type="submit" class="btn btn-primary btn-lg mt-2">Verstuur</button>
            </div>
        </form>
    </div>
</div>

    </div>

    


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-FKyeEForCGlyvwX9Hj09JcYn3n7wiPVLZ7YYwJrWcXK/BmmVDxM+D2scQbITxI"
            crossorigin="anonymous"></script>
</body>
</html>