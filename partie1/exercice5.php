<!DOCTYPE HTML>
<html lang="fr">
    <head>
        <title>Exercice 5 - Partie 1</title>
        <meta charset="UTF-8" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
        <link rel="stylesheet" href="style.css" />
    </head>
    <body>
        <?php
        include 'id.php';
        $dbh = new PDO('mysql:host=localhost;dbname=colyseum', $user, $password);
        try {
            $req = $dbh->query("SELECT `lastName`, `firstName`, `card` FROM `clients`WHERE `lastName` LIKE 'm%' ORDER BY ` AlastName` ASC");
            $row = $req->fetchAll();
            foreach ($row as $clients) {
                echo utf8_encode('Nom : ' . $clients['lastName']);
                ?><br/><?php
                echo utf8_encode('Prenom : ' . $clients['firstName']);
                ?><br/><?php
                ;
            }
            $dbh = null;
        } catch (PDOException $e) {
            echo 'Erreur!: ' . $e->getMessage() . ' < br/>';
            die();
        }
        ?>
    </body>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="projet.js"></script>
</html>