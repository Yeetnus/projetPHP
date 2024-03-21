<?php require_once "../verification.php" ?>
<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8" />
    <title>Modification médecin</title>
    <link rel="stylesheet" href="../../CSS/style.css">
    <link rel="icon" href="../../IMAGES/logo_cabinet.png">
</head>

<header>
<?php include "../../HTML/header.php"; ?>
</header>

<body>
    <div class="content-wrapper">
        <div class="login-box" id="a_masquer">
            <h2>Modifier le médecin</h2>
            <form action="#" method="post" class="formulaire">
                <div class="user-box">
                    <input id="nom-med" type="text" name="nom" required="">
                    <label>Nom</label>
                </div>
                <div class="user-box">
                    <input id="prenom-med" type="text" name="prenom" required="">
                    <label>Prénom</label>
                </div>
                <div class="user-box">
                    <input id="civ-med" type="text" name="civ" required="">
                    <label>Civlité (M ou MME)</label>
                </div>
                <button type="submit" name="Valider">Valider</button>
                <button onclick="resetInput()" name="Annuler">Annuler</button>
            </form>
        </div>
        <form action="../logout.php" method="post">
            <input id="logout" type="submit" value="Logout">
        </form>
    </div>
</body>

</html>