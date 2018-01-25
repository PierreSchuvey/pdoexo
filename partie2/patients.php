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
        <h1>Page du profil de <?= $_GET['idPatient']; ?></h1>
        <?php
        include 'id.php';
        include 'util.php';
        $idPatients = $_GET['idPatient'];
        $req = $dbh->query('SELECT `id`,`lastName`,`firstName`,`birthDate`,`phone`,`mail` FROM patients WHERE firstName = \'' . $idPatients . '\'');
        $row = $req->fetch();
        $idPatients = $row['id'];
        $req = $dbh->query('SELECT `appointments`.`id` AS idAppointments, `appointments`.`dateHour` AS dateHour, `appointments`.`idPatients` AS appointmentsPatient, `patients`.`firstName` AS firstName, `patients`.`lastName` AS lastName FROM `appointments` INNER JOIN `patients` WHERE `idPatients` = ' . $idPatients . '');
        $appointments = $req->fetch();
        ?>
        <div id="profil">
            <h1><?php echo $row['firstName']; ?></h1>
            <p>id : <?= $row['id'] ?></p>
            <p>Nom : <?= $row['lastName'] ?></p>
            <p>Prenom : <?= $row['firstName'] ?></p>
            <p>Dat de naissance : <?= $row['birthDate'] ?></p>
            <p>Téléphone : <?= $row['phone'] ?></p>
            <p>Mail : <?= $row['mail'] ?></p>
        </div>
        <div id="RDV">
            <h2>Liste des rendez-vous</h2>
            <p>id : <?= $appointments['idAppointments'] ?></p>
            <p>Date et heure : <?= $appointments['dateHour'] ?></p>
        </div>
        <h2> Modifier les donées de <?= $_GET['idPatient']; ?></h2>
        <form action="#" method="POST">
            <div class="form-group">
                <label for="firstName">Prénom*</label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="firstName" placeholder="Veuillez renseigner votre prénom">
            </div>
            <div class="form-group">
                <label for="lastName">Nom*</label>
                <input type="text" class="form-control" id="exampleInputPassword1" name="lastName" placeholder="Veuillez renseigner votre nom">
            </div>
            <div class="form-group">
                <label for="birthDate">Date de naissance*</label>
                <input type="date" class="form-control" id="exampleInputPassword1" name="birthDate" placeholder="Veuillez renseigner votre date de naissance">
                <small>La date doit être renseigné sous le format suivant (jj/mm/aaaa)</small>
            </div>
            <div class="form-group">
                <label for="phoneNumber">Numéro de téléphone</label>
                <input type="phone" class="form-control" id="exampleInputPassword1" name="phoneNumber" placeholder="Veuillez renseigner votre numéro de téléphone">
                <small>La numéro est accepter dans toute les syntaxes</small>
            </div>
            <div class="form-group">
                <label for="mail">E-mail*</label>
                <input type="mail" class="form-control" id="exampleInputPassword1" name="mail" placeholder="Veuillez renseigner votre e-mail">
            </div>
            <button type="submit" class="btn btn-primary">Valider l'ajout du patient</button>
        </form>
        <small>*Tous les champs libéllés avec un astérisque doit être obligatoirement remplis</small>
    </body>
    <?php
    if (!empty($_POST['firstName']) && !empty($_POST['lastName']) && !empty($_POST['mail'])) {
        if (preg_match('^[A-Z]{1}[a-zéèäëïöü]+^', $_POST['firstName'])) {
            if (preg_match('^[A-Z]+^', $_POST['lastName'])) {
                if (preg_match('^0[1-9][.-\/]?[0-9]{2}[.-\/]?[0-9]{2}[.-\/]?[0-9]{2}[.-\/]?[0-9]{2}^', $_POST['phoneNumber'])) {
                    if (preg_match('^[A-Za-z0-9]+[@]{1}[A-Za-z0-9]+[.][a-z]+^', $_POST['mail'])) {
                        include 'id.php';
                        include 'util.php';
                        $namePatient = $_GET['idPatient'];
                        $firstName = $_POST['firstName'];
                        $lastName = $_POST['lastName'];
                        $birthDate = $_POST['birthDate'];
                        $phone = $_POST['phoneNumber'];
                        $mail = $_POST['mail'];
                        $req = $dbh->prepare('UPDATE `patients` SET `lastName` = :lastName, `firstName` = :firstName, `birthDate` = :birthDate, `phone` = :phone, `mail` = :mail WHERE `firstName` = ' . $namePatient . '');
                        $req->execute(array('lastName' => $lastName, 'firstName' => $firstName, 'birthDate' => $birthDate, 'phone' => $phone, 'mail' => $mail));
                        echo 'Inscription du patient validé !';
                    }
                } else {
                    echo 'Phone null!';
                }
            } else {
                echo 'Votre nom n\'est pas valide !';
            }
        } else {
            echo 'Votre prénom n\'est pas valide !';
        }
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

