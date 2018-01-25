<!DOCTYPE HTML>
<html lang="fr">
    <head>
        <title>Ajout de patients</title>
        <meta charset="UTF-8" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="table.css">
    </head>
    <header>
        <nav class="navbar navbar-light bg-faded">
            <a class="navbar-brand" href="index.php">Accueil</a>
            <a class="navbar-brand" href="ajout-patient.php">Ajouter patients</a>
            <a class="navbar-brand" href="liste-patients.php">Liste des patients</a>
            <a class="navbar-brand" href="ajout-RDV.php">Ajouter RDV</a>
            <a class="navbar-brand" href="liste-RDV.php">Liste des RDV</a>
        </nav>
    </header>
    <body>
        <form action="#" methos="GET">
            <label for="searchPatients">Chercher un patient : </label>
            <input type="text" name="searchPatients">
            <input type="submit" value="Rechercher">
        </form>
        <?php
        if (empty($_GET['searchPatients'])) {
            ?>
            <h1>Liste des patients</h1>
            <?php
            include 'id.php';
            $dbh = new PDO('mysql:host=localhost;dbname=HospitalE2N', $user, $password);
            $req = $dbh->query("SELECT `id`, `lastName`, `firstName`, `birthDate`, `phone`, `mail` FROM `patients`");
            $row = $req->fetchAll();
            ?>
            <table>
                <thead>
                <td class="tdHead">Id</td>
                <td class="tdHead">Nom</td>
                <td class="tdHead">Prenom</td>
                <td class="tdHead">Date de naissance</td>
                <td class="tdHead">Carte</td>
                <td class="tdHead">Numero de carte</td>
                <td class="tdHead">Fiche</td>
            </thead>
            <?php
            foreach ($row as $clients) {
                ?>
                <form action="<?= $clients['firstName'] ?>" method="POST">
                    <tbody>
                        <tr>
                            <td><?php echo utf8_encode($clients['id']); ?></td>
                            <td><?php echo utf8_encode($clients['lastName']); ?></td>
                            <td><?php echo utf8_encode($clients['firstName']); ?></td>
                            <td><?php echo utf8_encode($clients['birthDate']); ?></td>
                            <td><?php echo utf8_encode($clients['phone']); ?></td>
                            <td><?php echo utf8_encode($clients['mail']); ?></td>
                            <td> <button id="submitShasseurs" type="submit">Voir la fiche du patient</button></td>
                        </tr>
                    </tbody>
                </form>

                <?php
            }
            ?>
        </table>
        <?php
    } else {
        ?>
        <h1>Liste des patients</h1>
        <?php
        $searched = $_GET['searchPatients'];
        include 'id.php';
        $dbh = new PDO('mysql:host=localhost;dbname=HospitalE2N', $user, $password);
        $req = $dbh->query('SELECT firstName, lastName, id, birthDate, phone, mail FROM `patients`WHERE `firstName` LIKE \'%' . $searched . '%\'');
        $row = $req->fetchAll();
        ?>
        <table>
            <thead>
            <td class="tdHead">Id</td>
            <td class="tdHead">Nom</td>
            <td class="tdHead">Prenom</td>
            <td class="tdHead">Date de naissance</td>
            <td class="tdHead">Téléphone</td>
            <td class="tdHead">Mail</td>
            <td class="tdHead">Fiche</td>
        </thead>
        <?php
        foreach ($row as $clients) {
            ?>
            <form action="<?= $clients['firstName'] ?>" method="POST">
                <tbody>
                    <tr>
                        <td><?php echo utf8_encode($clients['id']); ?></td>
                        <td><?php echo utf8_encode($clients['lastName']); ?></td>
                        <td><?php echo utf8_encode($clients['firstName']); ?></td>
                        <td><?php echo utf8_encode($clients['birthDate']); ?></td>
                        <td><?php echo utf8_encode($clients['phone']); ?></td>
                        <td><?php echo utf8_encode($clients['mail']); ?></td>
                        <td> <button id="submitShasseurs" type="submit">Voir la fiche du patient</button></td>
                    </tr>
                </tbody>
            </form>

            <?php
        }
    }
    ?>
    <button id="deleteApp">Supprimer un patient</button>
    <form id="deleteForm" method="POST">
        <label for="idDeleteApp">Sélectionnez l'id du patient à supprimer</label>
        <select name = "idDeleteApp">
            <?php
            foreach ($row as $clients) {
                ?>
                <option><?php echo utf8_encode($clients['id']); ?></option>
                <?php
            }
            ?>
        </select>
        <input type="submit" value="Confirmer la suppression du patient">
    </form>
    <?php
    if (isset($_POST['idDeleteApp'])) {
        $idDeletePatient = $_POST['idDeleteApp'];
        $req = $dbh->prepare('DELETE patients, appointments FROM appointments LEFT JOIN patients ON patients.id = idPatients WHERE idPatients =' . $idDeletePatient . '');
        $req->execute();
    } else {
        echo 'Veuillez sélectionner un ID valide !';
    }
    ?>
</body>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="deleteApp.js"></script>
</html>

