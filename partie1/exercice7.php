<!DOCTYPE HTML>
<html lang="fr">
    <head>
        <title>Exercice 7 - Partie 1</title>
        <meta charset="UTF-8" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="table.css">
    </head>
    <body>
        <?php
        include 'id.php';
        $dbh = new PDO('mysql:host=localhost;dbname=colyseum', $user, $password);
        try {
            $req = $dbh->query("SELECT `lastName`, `firstName`, `birthDate`, `card`, `cardNumber` FROM `clients`");
            $row = $req->fetchAll();
            ?>
            <table>
                <thead>
                <td class="tdHead">Nom</td>
                <td class="tdHead">Prenom</td>
                <td class="tdHead">Date de naissance</td>
                <td class="tdHead">Carte</td>
                <td class="tdHead">Numero de carte</td>
            </thead>
            <?php
            foreach ($row as $clients) {
                ?>
                <tbody>
                    <tr>
                        <td><?php echo utf8_encode($clients['lastName']); ?></td>
                        <td><?php echo utf8_encode($clients['firstName']); ?></td>
                        <td><?php echo utf8_encode($clients['birthDate']); ?></td>
                        <td><?php echo utf8_encode($clients['card']); ?></td>
                        <td><?php echo utf8_encode($clients['cardNumber']); ?></td>
                    </tr>
                </tbody><?php
            }
            ?>
        </table>
        <?php
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