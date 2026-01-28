<?php
include('config/config.php');

$dsn = "mysql:host=$dbHost;dbname=$dbName;charset=utf8";

    $pdo = new PDO($dsn, $dbUser, $dbPass);

    
        $sql = "DELETE FROM Rollercoaster WHERE Id = :id";
        $statement = $pdo->prepare($sql);
        $statement->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
        $statement->execute();

    header('Refresh: 3; url=index.php');
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD met PHP en MySQL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet"
          crossorigin="anonymous">
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-10">
            <div class="alert alert-success text-center" role="alert">
                De gegevens zijn verwijderd. U wordt teruggestuurd naar de index-pagina...
            </div>
        </div>
    </div>
</div>
</body>
</html>
