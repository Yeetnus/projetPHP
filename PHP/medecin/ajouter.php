<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8" />
    <title>Page de test</title>
    <link rel="stylesheet" href="../../CSS/style.css">
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
    <h2>Page d'ajout</h2>
    <form action="#" method="post">
        <label>Nom :</label>
        <input name="nom" id="nom" type="text" required/></p>

        <label>Prénom:</label>
        <input name="prenom" id="prenom" type="text" required/></p>

        <label>Civilité :</label>
        <input name="civ" id="civ" type="text" required/></p>

        <button type="submit" name="Valider">Valider</button>
        <button type="reset" name="Annuler">Annuler</button>
        <?php
        require("../../BDD/BDDmedecin.php");
        $BDD = new BDDmedecin();

        if(array_key_exists('Valider', $_POST)) { 
            $prenom = $_POST['prenom'];
            $nom = $_POST['nom'];
            $civ = $_POST['civ'];
            $BDD->insert($nom, $prenom, $civ);
        } 
                
        ?>
    </form>
</body>

</html>