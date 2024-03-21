<?php require_once "../verification.php" ?>
<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8" />
    <title>Modifier médecin</title>
    <link rel="stylesheet" href="../../CSS/style.css">
    <link rel="icon" href="../../IMAGES/logo_cabinet.png">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" src="../../JS_client/medecin.js"></script>
    
</head>

<header>
    <?php include "../../HTML/header.php"; ?>
</header>

<body>
    <div class="content-wrapper">
        <div class="scrollable-div">
            <form action="../logout.php" method="post">
                <input id="logout" type="submit" value="Logout">
            </form>
            <h2 class="h2page">Sélectionnez le médecin que vous souhaitez modifier</h2>
            <input type="text" id="myInput" onkeyup="recherche()" placeholder="Rechercher par noms...">
            <table id="myTable">
                <tr>
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th>Civilité</th>
                    <th>Choix</th>
                </tr>
                <tr>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                </tr>
            </table>
            <button class="retour" onclick="location.href='../../choix.php'">Retour</button>
        </div>
    </div>
</body>

</html>