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
        <?php
        include 'id.php';
        include 'util.php';
        $idApp = $_GET['idRDV'];
        $req = $dbh->query('SELECT `appointments`.`id` AS idAppointments, `appointments`.`dateHour` AS dateHour, `appointments`.`idPatients` AS appointmentsPatient, `patients`.`firstName` AS firstName, `patients`.`lastName` AS lastName FROM `appointments` INNER JOIN `patients` WHERE `appointments`.`idPatients` = `patients`.`id` AND `appointments`.`id` = ' . $idApp . ' ');
        $row = $req->fetch();
        ?>
        <div id="profil">
            <h1>Page du rendez vous n° <?= $idApp; ?></h1>
            <p>id : <?= $row['idAppointments']; ?></p>
            <p>Nom : <?= $row['lastName']; ?></p>
            <p>Prenom : <?= $row['firstName']; ?></p>
            <p>Date et heure: <?= $row['dateHour']; ?></p>
        </div>
        <h2> Modifier les donées du RDV</h2>
        <form action="#" method="POST">
            <div class="form-group">
                <label for="appointmentDate">Date du rendez-vous*</label>
                <input type="date" class="form-control" id="exampleInputEmail1" name="appointmentDate" placeholder="Veuillez renseigner votre prénom">
            </div>
            <div class="form-group">
                <label for="appointmentTime">Heure du rendez-vous*</label>
                <input type="text" class="form-control" id="exampleInputPassword1" name="appointmentTime" placeholder="Veuillez renseigner votre nom">
                <small>Format : 00:00:00</small>
            </div>
            <div class="form-group">
                <?php
                include 'id.php';
                include 'util.php';
                $req = $dbh->query('SELECT `id`FROM `patients`');
                $row = $req->fetchAll();
                ?>
                <label for="appointmentPatient">Patient à prendre en charge*</label>
                <select type="date" class="form-control" id="exampleInputPassword1" name="appointmentPatient" placeholder="Veuillez renseigner votre date de naissance">
                    <?php
                    foreach ($row as $patients) {
                        ?><option><?php echo $patients['id'] ?></option><?php
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Valider RDV</button>
        </form>
        <small>*Tous les champs libéllés avec un astérisque doit être obligatoirement remplis</small>
    </body>
    <?php
    if (!empty($_POST['appointmentDate']) && !empty($_POST['appointmentTime']) && !empty($_POST['appointmentPatient'])) {
        include 'id.php';
        include 'util.php';
        $dateHour = $_POST['appointmentDate'] . ' ' . $_POST['appointmentTime'];
        $patient = $_POST['appointmentPatient'];
        $req = $dbh->prepare('UPDATE `appointments` SET `dateHour` = :dateHour, `idPatients` = :idPatients WHERE `id` = ' . $idApp . '');
        $req->execute(array('dateHour' => $dateHour, 'idPatients' => $patient));
        echo 'Inscription du patient validé !';
    } else {
        echo 'Veuillez remplir tous les champs obligatoires';
    }
    ?>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="/partie2/updateProfil.js"></script>
    <script src="projet.js"></script>
</html>

