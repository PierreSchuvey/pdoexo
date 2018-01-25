<!DOCTYPE HTML>
<html lang="fr">
    <head>
        <title>Ajout de patients</title>
        <meta charset="UTF-8" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
        <link rel="stylesheet" href="style.css" />
    </head>
    <nav class="navbar navbar-light bg-faded">
        <a class="navbar-brand" href="index.php">Accueil</a>
        <a class="navbar-brand" href="ajout-patient.php">Ajouter patients</a>
        <a class="navbar-brand" href="liste-patients.php">Liste des patients</a>
        <a class="navbar-brand" href="ajout-RDV.php">Ajouter RDV</a>
        <a class="navbar-brand" href="liste-RDV.php">Liste des RDV</a>
    </nav>
    <body>
        <h1>Ajouter un patient</h1>
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
            <button type="submit" class="btn btn-primary">Valider Modification</button>
        </form>
        <small>*Tous les champs libéllés avec un astérisque doit être obligatoirement remplis</small>
        <?php
        if (!empty($_POST['firstName']) && !empty($_POST['lastName']) && !empty($_POST['mail'])) {
            if (preg_match('^[A-Z]{1}[a-zéèäëïöü]+^', $_POST['firstName'])) {
                if (preg_match('^[A-Z]+^', $_POST['lastName'])) {
                    if (preg_match('^0[1-9][.-\/]?[0-9]{2}[.-\/]?[0-9]{2}[.-\/]?[0-9]{2}[.-\/]?[0-9]{2}^', $_POST['phoneNumber'])) {
                        if (preg_match('^[A-Za-z0-9]+[@]{1}[A-Za-z0-9]+[.][a-z]+^', $_POST['mail'])) {
                            include 'id.php';
                            include 'util.php';
                            $firstName = $_POST['firstName'];
                            $lastName = $_POST['lastName'];
                            $birthDate = $_POST['birthDate'];
                            $phone = $_POST['phoneNumber'];
                            $mail = $_POST['mail'];
                            $req = $dbh->prepare('INSERT INTO `patients` (`lastName`, `firstName`, `birthDate`, `phone`, `mail`) VALUES (:lastName, :firstName, :birthDate, :phone, :mail)');
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
    </body>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="projet.js"></script>
</html>

