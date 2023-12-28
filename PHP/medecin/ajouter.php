<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Page de test</title>
        <link rel="stylesheet" href="../CSS/style.css">
    </head>
    <header>
        <nav>
            <ul>
                <li class="deroulant"><a href="#">Médecin &ensp;</a>
                <ul class="sous">
                    <li><a href="supprimer.php">Supprimer un médecin</a></li>
                    <li><a href="ajouter.php">Ajouter un médecin</a></li>
                    <li><a href="action.php">Modifier un médecin</a></li>
                </ul>
                </li>
                <li class="deroulant"><a href="#">Usager &ensp;</a>
                <ul class="sous">
                <li><a href="supprimer.php">Supprimer un usager</a></li>
                    <li><a href="ajouter.php">Ajouter un usager</a></li>
                    <li><a href="action.php">Modifier un usager</a></li>
                </ul>
                </li>
                <li class="deroulant"><a href="#">Consultations &ensp;</a>
                <ul class="sous">
                <li><a href="supprimer.php">Supprimer</a></li>
                    <li><a href="ajouter.php">Ajouter</a></li>
                    <li><a href="action.php">Modifier</a></li>
                </ul>
                </li>
                <li><a href="#">A propos</a></li>
            </ul>
        </nav>
    </header>
    <body>
        <div class="choice-box">
        <h2>Page d'ajout</h2>
        <!--Bonjour, <?php echo htmlspecialchars($_POST['nom']); ?>.
        Tu as <?php echo (int)$_POST['age']; ?> ans.-->
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
            <input name="daten" id="daten" type="text" /></p>

            <label>Lieu de naissance :</label>
            <input name="lieun" id="lieun" type="text" /></p>

            <button type="submit" name="Valider">Valider</button>
            <button type="submit" name="Annuler">Annuler</button>
            
        </form>
        </div>
    </body>
</html>