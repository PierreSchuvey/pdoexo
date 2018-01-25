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
        <h1>Liste des RDV</h1>
        <?php
        include 'id.php';
        $dbh = new PDO('mysql:host=localhost;dbname=HospitalE2N', $user, $password);
        $req = $dbh->query("SELECT `appointments`.`id` AS idAppointments, `appointments`.`dateHour` AS dateHour, `appointments`.`idPatients` AS appointmentsPatient, `patients`.`firstName` AS firstName, `patients`.`lastName` AS lastName FROM `appointments` INNER JOIN `patients` WHERE `appointments`.`idPatients` = `patients`.`id` ");
        $row = $req->fetchAll();
        ?>
        <table>
            <thead>
            <td class="tdHead">Id</td>
            <td class="tdHead">Date et Heure</td>
            <td class="tdHead">Nom du patient</td>
            <td class="tdHead">Prénom du patient</td>
            <td class="tdHead">Nom du patient</td>
            <td class="tdHead">Fiche</td>
        </thead>
        <?php
        foreach ($row as $clients) {
            ?>
            <form action="<?= $clients['idAppointments'] ?>" method="POST">
                <tbody>
                    <tr>
                        <td><?php echo utf8_encode($clients['idAppointments']); ?></td>
                        <td><?php echo utf8_encode($clients['dateHour']); ?></td>
                        <td><?php echo utf8_encode($clients['appointmentsPatient']); ?></td>
                        <td><?php echo utf8_encode($clients['firstName']); ?></td>
                        <td><?php echo utf8_encode($clients['lastName']); ?></td>
                        <td> <button id="submitShasseurs" type="submit">Voir la fiche du patient</button></td>
                    </tr>
                </tbody>
            </form><?php
        }
        ?>
    </table>
    <button id="deleteApp">Supprimer un RDV</button>
    <form id="deleteForm" method="POST">
        <label for="idDeleteApp">Sélectionnez l'id du RDV à supprimer</label>
        <select name="idDeleteApp">
            <?php
            foreach ($row as $clients) {
                ?>
                <option><?php echo utf8_encode($clients['idAppointments']); ?></option>
                <?php
            }
            ?>
        </select>
        <input type="submit" value="Confirmer la suppression du RDV">
    </form>
    <?php
    if (isset($_POST['idDeleteApp'])) {
        $idDeleteApp = $_POST['idDeleteApp'];
        $req = $dbh->prepare('DELETE FROM `appointments` WHERE `id` =' . $idDeleteApp . '');
        $req->execute();
    } else {
        echo 'Veuillez sélectionner un ID valide !';
    }
    ?>
</body>
<script src = "https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="deleteApp.js"></script>
</html>

