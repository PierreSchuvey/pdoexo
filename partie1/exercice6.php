<!DOCTYPE HTML>
<html lang="fr">
    <head>
        <title>Exercice 6 - Partie 1</title>
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
            $req = $dbh->query("SELECT `title`, `performer`, `date`, `startTime` FROM `shows`");
            $row = $req->fetchAll();
            foreach ($row as $clients) {
                echo utf8_encode($clients['title'] . ', ' . $clients['performer'] . ', ' . $clients['date'] . ', ' . $clients['startTime']);
                ?><br/><?php
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