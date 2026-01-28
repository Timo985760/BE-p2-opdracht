<?php

// toevoegen van config php bestand.
include('config/config.php');

// Data source string (Gegevens van database, om te kunnen verbinden).
$dsn = "mysql:host=$dbHost;dbname=$dbName;charset=utf8";

// PDO object (Verbinding maken met de database)
$pdo = new PDO($dsn, $dbUser, $dbPass);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Gegevens ophalen uit DataBase, Hoogte aflopend
$sql = "SELECT R.Id
              ,R.Rollercoaster AS NameRC
              ,R.AmusementPark AS NameAP
              ,R.Country
              ,R.TopSpeed
              ,R.Height
              ,DATE_FORMAT(R.YearOfConstruction, '%d-%m-%Y') AS YOFC
        FROM  Rollercoaster AS R
        ORDER BY R.Height DESC";

// Met de method prepare van het PDO-Object maak je de sql-query
// klaar voor het PDO-Object om uitgevoerd te worden.
// De geprepareerde sql-query stoppen we in een variable $statement.
$statement = $pdo->prepare($sql);

// Geprepareerde sql-query uitvoeren op de database.
$statement->execute();

// De geselecteerde records binnenhalen als array en stop ze in de variable $result.
$result = $statement->fetchAll(PDO::FETCH_OBJ);

// Toon de geselecteerde data uit de DB
?>

<!------------------------------------------------------------------------------------------------------------->
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
  </head>

  <body>
    <div class="container mt-4">
      <div class="row justify-content-center">
        <div class="col-10">
          <h2 class="mb-4"><u>Hoogste achtbanen van Europa</u></h2>

          <div class="row justify-content-center my-3">
            <div class="col-10"><h6>Nieuwe Achtbaan <a href="./create.php"><i class="bi bi-plus-square text-danger"></i></a></h6></div>
          </div>

          <table class="table table-striped table-bordered table-hover">
            <thead class="table-dark">
              <tr>
                <th>Naam (RC)</th>
                <th>Naam (AP)</th>
                <th>Land</th>
                <th>Top Snelheid</th>
                <th>Hoogte</th>
                <th>Bouwjaar</th>
                <th>Wijzig</th>
                <th>Verwijder</th>
              </tr>
            </thead>

            <tbody>
              <?php foreach ($result as $rollercoaster): ?>
                <tr>
                  <td><?= $rollercoaster->NameRC ?></td>
                  <td><?= $rollercoaster->NameAP ?></td>
                  <td><?= $rollercoaster->Country ?></td>
                  <td><?= $rollercoaster->TopSpeed ?> km/h</td>
                  <td><?= $rollercoaster->Height ?> m</td>
                  <td><?= $rollercoaster->YOFC ?></td>
                  <td class='text-center'>
                    <a href="update.php?id=<?= $rollercoaster->Id; ?>">
                      <i class="bi bi-pencil-square text-success"></i>
                    </a>
                  </td>
                  <td class='text-center'>
                    <a href="delete.php?id=<?= $rollercoaster->Id; ?>">
                    <i class="bi bi-x-square text-danger"></i>
                    </a>

              </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>

        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>