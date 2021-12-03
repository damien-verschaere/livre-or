<?php
session_start();
require('require/backend.php');

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <title>Livre D'Or</title>
</head>
<body>
    <header>
        <p class="bonjour"><?php if(isset($_SESSION['login'])) echo "bonjour " .$_SESSION['login']; ?></p>
        <ul class="liste">
            <li><a href=""> Accueil</a> </li>
           <?php tete(); ?>
        </ul>
    </header>
    <main>
        <div class="titre" ><h1>Livre D'or</h1></div>
        <div class="fondecran" >
            <img src="images/laurier.png" alt="couronne de laurier" height="500">
        </div>
    </main>
    <footer>
    <a href="https://github.com/damien-verschaere/livre-or"><img src="images/github.png" alt="logo github" height="200"></a> 
    </footer>
</body>
</html>