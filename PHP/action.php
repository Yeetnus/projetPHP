<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>Page de test</title>
        <link rel="stylesheet" href="../CSS/style.css">
    </head>
    <body>
    <div class="choice-box">
    
    <h2>Page de suppression</h2>
        <form action="#" method="post">
            <label>Nom :</label>
            <input name="nom" id="nom" type="text" /></p>

            <label>Prénom:</label>
            <input name="prenom" id="prenom" type="text" /></p>

            <label>Civilité :</label>
            <input name="civ" id="civ" type="text" /></p>

            <label>Adresse Complète :</label>
            <input name="adr" id="adr" type="text" /></p>

            <label>Date de naissance :</label>
            <input name="dateN" id="dateN" type="text" /></p>

            <label>Lieu de naissance :</label>
            <input name="lieuN" id="lieuN" type="text" /></p>

            <button type="submit" name="Valider">Valider</button>
            <button type="submit" name="Annuler">Annuler</button>
            <?php
            require("BDDusager.php");
            $BDD =new BDDusager();
            $BDD->select("medecin");
            ?>
            
        </form>
</div>
    </body>
</html>