<?php require_once "PHP/verification.php" ?>
<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8" />
    <title>Page de test</title>
    <link rel="stylesheet" href="../../CSS/style.css">
    <script type="text/javascript">
        function displayValues() {
            var name = localStorage.getItem("name");
            document.getElementById("result-name").innerHTML = name;
        }
        window.onload = displayValues;
        function resetInput() {
            document.getElementById("nom-formulaire").value = "";
        }
    </script>
</head>
<?php include "../../HTML/header.php"; ?>

<body>
    <div class="content-wrapper">
        <div class="content">
            <div class="scrollable-div login-box" id="a_masquer">
                <h2>Ajouter un médecin</h2>
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
                                <input id="result-name" type="text" name="nom" value ="<?php echo $row["Nom"]?>" required="">
                                <label>Nom</label>
                            </div>
                            <div class="user-box">
                                <input type="text" name="prenom" value ="<?php echo $row["Prenom"]?>" required="">
                                <label>Prénom</label>
                            </div>
                            <div class="user-box">
                                <input type="text" name="civ" value ="<?php echo $row["Civilite"]?>" required="">
                                <label>Civlité</label>
                            </div>
                            <button type="submit" name="Valider">Valider</button>
                            <button onclick="resetInput()" name="Annuler">Annuler</button>

                        <?php }
                    } 
                    if (array_key_exists('Valider', $_POST)) {
                        $prenom = $_POST['prenom'];
                        $nom = $_POST['nom'];
                        $civ = $_POST['civ'];
                        $BDD->update($recordID, $nom, $prenom, $civ);
                        echo '<script>window.location.href="modifier.php";</script>';
                      }
                    ?>
                </form>
            </div>
        </div>
    </div>
</body>

</html>