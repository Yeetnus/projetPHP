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
            <label>Nombre 1 :</label>
            <input name="nb1" id="nb1" type="number" value="<?php if(!empty($_POST['nb1'])){
                 echo $_POST['nb1'];
            }?>"/></p>

            <label>Nombre 2 :</label>
            <input name="nb2" id="nb2" type="number" value="<?php if(!empty($_POST['nb2'])){
                 echo $_POST['nb2'];
            }?>"/></p>

            <label>Résultat :</label>
            <input name="res" id="res" type="number" value="<?php if(isset($_POST['Additionner'])) {
                    $var=((int)$_POST['nb1']+(int)$_POST['nb2']);
                }
                if(isset($_POST['Soustraire'])) {
                    $var=((int)$_POST['nb1']-(int)$_POST['nb2']);
                }
                if(isset($_POST['Multiplier'])) {
                    $var=((int)$_POST['nb1']*(int)$_POST['nb2']);
                }
                if(isset($_POST['Diviser'])) {
                    if($_POST['nb2']!=0){
                        $var=((int)$_POST['nb1']/(int)$_POST['nb2']);
                    }else{
                        $var=0;
                    }
                }
                echo $var ?>"/></p>

            <label>Opérations</label>
            <button type="submit" name="Additionner">Additionner</button>
            <button type="submit" name="Soustraire">Soustraire</button>
            <button type="submit" name="Multiplier">Multiplier</button>
            <button type="submit" name="Diviser">Diviser</button>
            
        </form>
    </body>
</html>