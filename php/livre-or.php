<?php
session_start();
require('../require/backend.php');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/livre-or.css">
    <title>forum</title>
</head>
<body>
<header>
        <ul class="liste">
            <li><a href="../index.php"> Accueil</a> </li>
            
            <?php tete2(); ?>  
        </ul>
    </header>
    <main class=livreA >
        <?php affichageCom(); ?>
    </main>
    <footer>
        <a href="https://github.com/damien-verschaere/livre-or"><img src="../images/github.png" alt="logo github" height="200"></a> 
    </footer>
</body>
</html>