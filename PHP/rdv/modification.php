<?php require_once "../verification.php" ?>
<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8" />
    <title>Modification consultation</title>
    <link rel="stylesheet" href="../../CSS/style.css">
  <link rel="icon" href="../../IMAGES/logo_cabinet.png">
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
                <h2>Modifier la consultation</h2>
                <form action="#" method="post" class="formulaire">
                    <?php
                    require("../../BDD/BDDrdv.php");
                    if (isset($_GET['recordID'])) {
                        $recordId = $_GET['recordID'];
                        $BDD = new BDDrdv();
                        $records = $BDD->selectById($recordId);
                        while ($rowrdv = $records->fetch()) {
                            $recordID = $rowrdv["ID"];
                            ?>
                            <label>Date & heure</label>
                            <div class="user-box">
                                <input type="datetime-local" name="dateheure" value ="<?php echo $rowrdv["DateHeureRDV"]?>" required="">
                            </div>
                            <label>Durée</label>
                            <div class="user-box">
                                <input type="number" name="duree" value ="<?php echo $rowrdv["DuréeRDV"]?>" min="30" max="60" step="5" required="">
                                
                            </div>
                            
                             
                            <?php
                            require("../../BDD/BDDusager.php");
                            $BDDusa = new BDDusager();
                            $records = $BDDusa->select();
                            $recordNom = $BDDusa->selectNom($rowrdv["UsaID"]);
                            while ($usager = $recordNom->fetch()) { $nomusa = $usager["Nom"] . " " . $usager["Prenom"]; }
                            echo "<label>Usager</label>";
                            echo "<select id='liste_medecins' name='usaid'>";

                            $options = array();

                            while ($row = $records->fetch()) {
                                $recordIDusa = $row["ID"];
                                $option = "<option value='" . $row["ID"] . "'>" . $row["Nom"] . " " . $row["Prenom"] . "</option>";
                                
                                // Vérifie si l'option est égale à $nomusa
                                if ($option != "<option value='" . $recordIDusa . "'>" . $nomusa . "</option>") {
                                    // Ajoute l'option au tableau $options
                                    $options[] = $option;
                                }
                            }

                            // Déplace l'option de la variable $nomusa au début du tableau $options
                            array_unshift($options, "<option value='" . $recordIDusa . "'>" . $nomusa . "</option>");

                            // Affiche les options du tableau $options
                            foreach ($options as $option) {
                                if ($option !== $nomusa) {echo $option;}
                            }

                            echo "</select>"; ?>

                            <?php
                            require_once("../../BDD/BDDmedecin.php");
                            $BDDmed = new BDDmedecin();
                            $record = $BDDmed->select();
                            $recordNom = $BDDmed->selectNom($rowrdv["MedID"]);
                            while ($medecin = $recordNom->fetch()) { $nommed = $medecin["Nom"] . " " . $medecin["Prenom"]; }
                            echo "<label>Médecin</label>";
                            echo "<select id='liste_medecins' name='medid'>";
                            
                            while ($row = $record->fetch()) {
                                $recordIDmed = $row["ID"];
                                echo "<option value='" . $row["ID"] . "'>" . $row["Nom"] . " " . $row["Prenom"] . "</option>";

                                // Vérifie si l'option est égale à $nommed
                                if ($option != "<option value='" . $recordIDmed . "'>" . $nommed . "</option>") {
                                    // Ajoute l'option au tableau $options
                                    $options[] = $option;
                                }
                            }

                            array_unshift($options, "<option value='" . $recordIDmed . "'>" . $nommed . "</option>");

                            // Affiche les options du tableau $options
                            foreach ($options as $option) {
                                if ($option !== $nommed) {echo $option;}
                            }

                            // Close the select element
                            echo "</select>"; ?>

                            <button type="submit" name="Valider">Valider</button>
                            <button onclick="location.href='modifier.php'" name="Annuler">Annuler</button>

                        <?php }
                    } 
                    if (array_key_exists('Valider', $_POST)) {
                        $duree = $_POST['duree'];
                        $usaid = $_POST['usaid'];
                        $dateTime = $_POST['dateheure'];
                        $medid = $_POST['medid'];
                        $BDD->update($_GET['recordID'],$dateTime, $duree, $medid, $usaid);
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