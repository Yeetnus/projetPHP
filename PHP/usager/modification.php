<?php require_once "../verification.php" ?>
<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8" />
    <title>Modification usager</title>
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
            <div class="scrollable-div login-box" id="a_masquer">
                <h2>Modifier un usager</h2>
                <form action="#" method="post" class="formulaire">
                    <?php
                    require("../../BDD/BDDusager.php");
                    if (isset($_GET['recordID'])) {
                        $recordId = $_GET['recordID'];
                        $BDD = new BDDusager();
                        $records = $BDD->selectById($recordId);
                        while ($row = $records->fetch()) {
                            $recordID = $row["ID"];
                            ?>
                            <div class="user-box">
                                <input type="text" name="nom" value ="<?php echo $row["Nom"]?>" required="">
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
                            <div class="user-box">
                                <input type="text" name="adresse" value ="<?php echo $row["Adresse"]?>" required="">
                                <label>Adresse</label>
                            </div>
                            <label>Date de naissance</label>
                            <div class="user-box">
                                <input type="date" name="dateN" value ="<?php echo $row["DateNaissance"]?>" required>   
                            </div>     
                            <div class="user-box">
                                <input type="text" name="lieuN" value ="<?php echo $row["LieuNaissance"]?>" required="">
                                <label>Lieu de naissance</label>
                            </div>
                            <div class="user-box">
                                <input type="text" name="numsecu" value ="<?php echo $row["NumeroSecuriteSociale"]?>" required="">
                                <label>Numéro de sécurité soclaie</label>
                            </div>
                            
                            <?php
                            require("../../BDD/BDDmedecin.php");
                            $BDDmed = new BDDmedecin();
                            $records = $BDDmed->select();
                            $recordNom = $BDDmed->selectNom($row["MedID"]);
                            while ($medecin = $recordNom->fetch()) { $nommed = $medecin["Nom"] . " " . $medecin["Prenom"]; }
                            echo "<label>Médecin référent</label>";
                            echo "<select id='liste_medecins' name='medid'>";

                            $options = array();

                            while ($row = $records->fetch()) {
                                $recordID = $row["ID"];
                                $option = "<option value='" . $row["ID"] . "'>" . $row["Nom"] . " " . $row["Prenom"] . "</option>";
                                
                                // Vérifie si l'option est égale à $nommed
                                if ($option != "<option value='" . $recordID . "'>" . $nommed . "</option>") {
                                    // Ajoute l'option au tableau $options
                                    $options[] = $option;
                                }
                            }

                            // Déplace l'option de la variable $nommed au début du tableau $options
                            array_unshift($options, "<option value='" . $recordID . "'>" . $nommed . "</option>");

                            // Affiche les options du tableau $options
                            foreach ($options as $option) {
                                if ($option !== $nommed) {echo $option;}
                            }

                            echo "</select>"; ?>

                            <button type="submit" name="Valider">Valider</button>
                            <button onclick="location.href='modifier.php'" name="Annuler">Annuler</button>

                        <?php }
                    } 
                    if (array_key_exists('Valider', $_POST)) {
                        $prenom = $_POST['prenom'];
                        $nom = $_POST['nom'];
                        $civ = $_POST['civ'];
                        $adresse = $_POST['adresse'];
                        $lieuN = $_POST['lieuN'];
                        $numsecu = $_POST['numsecu'];
                        $date = $_POST['dateN'];
                        $dateN = new DateTime($date);
                        $medid = $_POST['medid'];
                        $BDD->update($_GET['recordID'], $nom, $prenom, $civ, $adresse, $dateN, $lieuN, $numsecu, $medid);
                        echo '<script>window.location.href="modifier.php";</script>';
                      }
                    ?>
                </form>
            </div>
            <form action="../logout.php" method="post" >
          <input id="logout" type="submit" value="Logout">
        </form>
    </div>
</body>

</html>