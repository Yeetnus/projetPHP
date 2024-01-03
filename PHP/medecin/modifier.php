<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>Page de test</title>
        <link rel="stylesheet" href="../../CSS/style.css">
    </head>
    <header>
  <?php include "../../HTML/header.php"; ?>
    </header>

    <body>
        <div class="scrollable-div choice-box">
        <h2>Page de suppression</h2>
        <form action="#" method="post" class="formulaire">
            <label>Nom :</label>
            <input name="nom" id="nom" type="text" /></p>

            <label>Prénom:</label>
            <input name="prenom" id="prenom" type="text" /></p>

            <label>Civilité :</label>
            <input name="civ" id="civ" type="text" /></p>

            <button type="submit" name="Valider">Valider</button>
            <button type="submit" name="Annuler">Annuler</button>
            <?php
        require("../../BDD/BDDmedecin.php");
        $BDD = new BDDmedecin();

        if(array_key_exists('Valider', $_POST)) { 
            $prenom = $_POST['prenom'];
            $nom = $_POST['nom'];
            $civ = $_POST['civ'];
            $BDD->insert($nom, $prenom, $civ);
            echo "<a href='ajouter.php'></a>";
        } 
                
        ?>
        </form>
        </div>
    </body>
</html>