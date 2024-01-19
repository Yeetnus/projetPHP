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
                <?php
                require("../../BDD/BDDmedecin.php");
                if (isset($_GET['recordID'])) {
                    $recordId = $_GET['recordID'];
                    $BDD = new BDDmedecin();
                    $records = $BDD->selectById($recordId);
                    while ($row = $records->fetch()) {
                        $recordID = $row["ID"];
                        ?>
                        <div class="user-box">
                            <input type="text" name="nom" value="<?php echo $row["Nom"] ?>" required="">
                            <label>Nom</label>
                        </div>
                        <div class="user-box">
                            <input type="text" name="prenom" value="<?php echo $row["Prenom"] ?>" required="">
                            <label>Prénom</label>
                        </div>
                        <div class="user-box">
                            <input type="text" name="civ" value="<?php echo $row["Civilite"] ?>" required="">
                            <label>Civlité (M ou MME)</label>
                        </div>
                        <button type="submit" name="Valider">Valider</button>
                        <button onclick="resetInput()" name="Annuler">Annuler</button>

                    <?php }
                }
                if (array_key_exists('Valider', $_POST)) {
                    if($_POST['civ']=='M' || $_POST['civ']=='MME') {
                        $prenom = $_POST['prenom'];
                        $nom = $_POST['nom'];
                        $civ = $_POST['civ'];
                        $BDD->update($recordID, $nom, $prenom, $civ);
                        echo '<script>window.location.href="modifier.php";</script>';
                    } else { 
                        echo 'La civilité doit être M ou MME.'; 
                    }
                }
                ?>
            </form>
        </div>
        <form action="../logout.php" method="post">
            <input id="logout" type="submit" value="Logout">
        </form>
    </div>
</body>

</html>