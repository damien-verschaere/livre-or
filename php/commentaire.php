<?php
session_start();
require('../require/backend.php');
com();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/inscription.css">
    <title>Document</title>
</head>
<body>
    <header>
        <ul class="liste">
            <li><a href="../index.php"> Accueil</a> </li>
            <?php tete2();   ?>  
        </ul>
    </header>
    <main class="test">
        <div class=cadre>
            <form action="commentaire.php" method="POST">
                <textarea name="com" cols="30" rows="10">votre texte</textarea>
                <input type="submit"name="postCom">
            </form>
        </div>
    </main>
    </main>
    <footer>
        <a href="https://github.com/damien-verschaere/livre-or"><img src="../images/github.png" alt="logo github" height="200"></a>
    </footer>
</body>
</html>