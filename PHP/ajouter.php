<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Page de test</title>
    </head>
    <body>

        <!--Bonjour, <?php echo htmlspecialchars($_POST['nom']); ?>.
        Tu as <?php echo (int)$_POST['age']; ?> ans.-->
        <form action="#" method="post">
            <label>Nom :</label>
            <input name="nb1" id="nb1" type="number" value="nom"/></p>

            <label>Prénom:</label>
            <input name="nb2" id="nb2" type="number" value="prenom"/></p>

            <label>Civilité :</label>
            <input name="res" id="res" type="number" value="civ"/></p>

            <label>Adresse Complète :</label>
            <input name="res" id="res" type="number" value="adr"/></p>

            <label>Date de naissance :</label>
            <input name="res" id="res" type="number" value="dateN"/></p>

            <label>Lieu de naissance :</label>
            <input name="res" id="res" type="number" value="lieuN"/></p>

            <button type="submit" name="Additionner">Valider</button>
            <button type="submit" name="Soustraire">Annuler</button>
            
        </form>
    </body>
</html>