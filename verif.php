<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hash Attack Challenge</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <?php
    if (isset($_POST["noms"]) && isset($_POST["login"]) &&  isset($_POST["password"])) {
        $dbh = new PDO('mysql:host=localhost;dbname=hashchallenge;charset=utf8', 'hashchallenge', '');
        $stmt = $dbh->prepare("INSERT INTO tentatives (noms, succes, datetime) VALUES (:noms, :succes, NOW())");
        $stmt->bindParam(':noms', $noms);
        $stmt->bindParam(':succes', $succes);

        if (hash("sha512", $_POST["login"]) == "4437287c9bad88168a8248351f9cb2418732fad4ef778d1db83a6a21ed3ddd51039e10a28544b203e2de0eb1a05805c822e133bdf280a2006f88c802523bf0a5"
            && hash("sha512", $_POST["password"]) == "7b510fbe195f2c6ca07fc0bc8564b4e6ce8dba5fe7c7dbc9c122fc15daabea60c902226f5e13f973b142c494fa05accd1713d4111abd972f8693d456a12e792e") {
            $succes = true;
            ?>
            <div class="alert alert-success" role="alert">
                Gagné !!! Félicitations !
            </div>
            <?php
        } else {
            $succes = false;
            ?>
            <div class="alert alert-danger" role="alert">
                Perdu... Essaye encore !
            </div>
            <?php
        }
        $noms = $_POST["noms"];
        $stmt->execute();
    }
    ?>
    <h2>Formulaire de vérification</h2>
    <p>Avez-vous trouvé l'identifiant et le mot de passe ? Essayez : </p>
    <form action="" method="post">
        <div class="mb-3">
            <label for="nomInput" class="form-label">Vos noms</label>
            <input type="text" class="form-control" id="nomInput" name="noms">
        </div>
        <div class="mb-3">
            <label for="loginInput" class="form-label">Identifiant</label>
            <input type="text" class="form-control" id="loginInput" name="login">
        </div>
        <div class="mb-3">
            <label for="passInput" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" id="passInput" name="password">
        </div>
        <button type="submit" class="btn btn-outline-dark">Envoyer</button>
    </form>
</div>

</body>
</html>