<?php
include('config/config.php');

$dsn = "mysql:host=$dbHost;dbname=$dbName;charset=utf8";
$pdo = new PDO($dsn, $dbUser, $dbPass, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);

$display = 'none';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $sql = "INSERT INTO Rollercoaster
    (
        RollerCoaster,
        AmusementPark,
        Country,
        TopSpeed,
        Height,
        YearOfConstruction
    )
    VALUES
    (
        :rollerCoaster,
        :amusementPark,
        :country,
        :topSpeed,
        :height,
        :yearOfConstruction
    )";

    $statement = $pdo->prepare($sql);

    $statement->bindValue(':rollerCoaster', $_POST['naamAchtbaan']);
    $statement->bindValue(':amusementPark', $_POST['naamPretpark']);
    $statement->bindValue(':country', $_POST['land']);
    $statement->bindValue(':topSpeed', $_POST['topsnelheid'], PDO::PARAM_INT);
    $statement->bindValue(':height', $_POST['hoogte'], PDO::PARAM_INT);
    $statement->bindValue(':yearOfConstruction', $_POST['bouwjaar']);

    $statement->execute();

    $display = 'flex';
    header('Refresh:3; index.php');
}
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hoogste Achtbanen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
          crossorigin="anonymous">
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    <div class="container mt-3">
        
        <div class="row justify-content-center" style="display:<?= $display ?? 'none'; ?>">
            <div class="col-6">
                <div class="alert alert-success text-center" role="alert">
                    De gegevens zijn toegevoegd. U Wordt teruggestuurd naar de index pagina.
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-6"><h3 class="text-primary">Voer een nieuwe achtbaan in:</h3></div>
        </div>
        
        <div class="row justify-content-center">
    <div class="col-6">
        <form action="create.php" method="POST">
            <div class="mb-3">
                <label for="inputNaamAchtbaan" class="form-label">Naam Achtbaan:</label>
                <input name="naamAchtbaan" placeholder="Vul de naam van de achtbaan in" type="text" class="form-control" id="inputNaamAchtbaan"
                       value="<?=$_POST['naamAchtbaan'] ?? '' ?>">
            </div>
            <div class="mb-3">
                <label for="inputNaamPretpark" class="form-label">Naam Pretpark:</label>
                <input name="naamPretpark" placeholder="Vul de naam van de achtbaan in" type="text" class="form-control" id="inputNaamPretpark"
                       value="<?=$_POST['naamPretpark'] ?? '' ?>">
            </div>
            <div class="mb-3">
                <label for="inputLand" class="form-label">Land:</label>
                <input name="land" placeholder="Vul de naam van het land in" type="text" class="form-control" id="inputLand"
                       value="<?=$_POST['land'] ?? '' ?>">
            </div>
            <div class="mb-3">
                <label for="inputTopsnelheid" class="form-label">Topsnelheid:</label>
                <input name="topsnelheid" placeholder="Vul de topsnelheid in" type="number" min="0" max="255" class="form-control" id="inputTopsnelheid"
                       value="<?=$_POST['topsnelheid'] ?? '' ?>">
            </div>
            <div class="mb-3">
                <label for="inputHoogte" class="form-label">Hoogte:</label>
                <input name="hoogte" placeholder="Vul de hoogte in" type="number" min="0" max="255" class="form-control" id="inputHoogte"
                       value="<?=$_POST['hoogte'] ?? '' ?>">
            </div>
            <div class="mb-3">
                <label for="inputYearOfConstruction" class="form-label">Bouwjaar:</label>
                <input name="bouwjaar" placeholder="Vul het bouwjaar in" type="date" min="0" max="255" class="form-control" id="inputYearOfConstruction"
                       value="<?=$_POST['bouwjaar'] ?? '' ?>">
            </div>
            <div class="d-grid gap-2">
                <button name="submit" type="submit" class="btn btn-primary btn-lg mt-2">Verstuur</button>
            </div>
        </form>
    </div>
</div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous">
    </script>
</body>
</html>