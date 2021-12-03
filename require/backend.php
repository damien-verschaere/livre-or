<?php
function tete(){
    if (empty($_SESSION['login'])) {
        echo "<li><a href=php/inscription.php> Inscription</a></li>";
        echo "<li><a href=php/connexion.php>Connexion</a></li>";
    }
    elseif (!empty($_SESSION['login'])) {
            echo "<li><a href=php/profil.php> Profil</a></li>";
            echo "<li><a href=php/livre-or.php>Livre d'or</a></li>";
            echo "<li><a href=php/deconnexion.php>deconnexion</a></li>";
        }
            
}

function tete2(){
    if (empty($_SESSION['login'])) {
        echo "<li><a href=inscription.php> Inscription</a></li>";
        echo "<li><a href=connexion.php>Connexion</a></li>";
    }
    elseif (!empty($_SESSION['login'])) {
            echo "<li><a href=profil.php> Profil</a></li>";
            echo "<li><a href=livre-or.php>Livre d'or</a></li>";
            echo "<li><a href=commentaire.php>Commentaire</a></li>";
            echo "<li><a href=deconnexion.php>deconnexion</a></li>";
        }
            
}
function inscription(){
    $bdd=mysqli_connect('localhost','root','','livreor');
    if (isset($_POST['validinscri'])){
        $login=$_POST['login'];
        $password=$_POST['password'];
        $password2=$_POST['password2'];
        
        if (empty($login)) {
            echo "<p> remplissez le champ login </p>";
        }
        elseif (empty($password)) {
            echo "<p> remplissez le champ password </p>";
            
        }
        elseif (!empty($login)) {
            $veriflogin=mysqli_query($bdd,"SELECT `login` FROM `utilisateurs` WHERE `login`= '$login'");
            var_dump(mysqli_num_rows($veriflogin) );
            if(mysqli_num_rows($veriflogin) == 1) {
                echo "<p> Le LOGIN existe deja .</p> ";    
            }
        elseif ($password != $password2) {
            echo "<p>les mdp ne coresponde pas</p>";
        }
        else {
                $cryptage=password_hash($password,PASSWORD_DEFAULT);
                $requete=mysqli_query($bdd,"INSERT INTO `utilisateurs` (`id`, `login`,`password`) VALUES (NULL, '$login','$cryptage')");
                header('location:' . 'connexion.php');
            }
        }
        
        
    }
}
function connexion(){
    if (isset($_POST['connect'])) {
        $message_connexion="Login ou MDP incorrect";
    $login=$_POST['login'];
    $password=$_POST['password'];
    $bdd=mysqli_connect('localhost','root','','livreor');
    mysqli_set_charset($bdd,'utf8');
    $requete=mysqli_query($bdd,"SELECT * FROM `utilisateurs` WHERE `login`= '$login'");
    $resultat=mysqli_fetch_assoc($requete);
    if (password_verify($password,$resultat['password'])) {  
        session_start();
        // on ouvre la session avec $_SESSION:
        $_SESSION['login'] = $login; // la session peut être appelée différemment et son contenu aussi peut être autre chose que le pseudo
        header('location:' . '../index.php');
}
else{
    echo "<p>".$message_connexion ."</p>" ;
}
}
}
function profil(){
    $bdd=mysqli_connect('localhost','root','','livreor');
    mysqli_set_charset($bdd,'utf8');
    $requete=mysqli_query($bdd,"SELECT `id`,`login`,`password` FROM `utilisateurs` WHERE `login`='$_SESSION[login]' ");
    $profil=mysqli_fetch_all($requete,MYSQLI_ASSOC);
    $login=$_SESSION['login'];
    foreach ($profil as $key ) {
        echo "<input type=hidden name=id value=" .$key['id'] .">";
        echo "<input type=text name=login value=" .$key['login'] .">";
    }
}
function modifProfil(){
    if (isset($_POST['modifProfil'])) {
        $loginvide= "veuillez remplir le champ login .";
        $bdd=mysqli_connect('localhost','root','','livreor');
        mysqli_set_charset($bdd,MYSQLI_ASSOC);
        if (empty($_POST['login'])) {
                echo"<p>" .$loginvide ."</p>";
        }
        elseif ($_SESSION['login'] == $_POST['login']) {
                $cryptage=password_hash($_POST['password'],PASSWORD_DEFAULT);
                $update=mysqli_query($bdd,"UPDATE `utilisateurs` SET `password`='$cryptage' WHERE `id`='$_POST[id]' ");
                $_SESSION=[];
                session_destroy();
                header('location:' . '../index.php');
        }
        elseif ($_SESSION['login'] != $_POST['login']) {
            $veriflogin=mysqli_query($bdd,"SELECT `login` FROM `utilisateurs` WHERE `login`= '$_POST[login]'");
            var_dump(mysqli_num_rows($veriflogin) );
            if(mysqli_num_rows($veriflogin) == 1) {
                echo "<p> Le LOGIN existe deja .</p> ";    
            }
            else {
                $cryptage=password_hash($_POST['password'],PASSWORD_DEFAULT);
                $update=mysqli_query($bdd,"UPDATE `utilisateurs` SET `login`='$_POST[login]',`password`='$cryptage' WHERE `id`='$_POST[id]' ");
                $_SESSION=[];
                session_destroy();
                header('location:' . '../index.php');
        }
           }
        }
}
function affichageCom(){
    $bdd=mysqli_connect('localhost','root','','livreor');
    $requete=mysqli_query($bdd,"SELECT * FROM `commentaires` INNER JOIN `utilisateurs` ON `commentaires`.id_utilisateur =`utilisateurs`.id ORDER BY `date` DESC ");
    $result=mysqli_fetch_all($requete,MYSQLI_ASSOC);
    foreach ($result as $key) {
       echo "<div class=carre>";
       echo "<p> posté le : " .$key['date'] . "</p>";
       echo "<p> par : " .$key['login'] . "</p>";
       echo "<p>" .$key['commentaire'] . "</p>";
       echo "</div>";
    }
} 
function Com(){
    $bdd=mysqli_connect('localhost','root','','livreor');
    $requeteid=mysqli_query($bdd,"SELECT `id` FROM `utilisateurs` WHERE `login`= '$_SESSION[login]'");
    $result=mysqli_fetch_assoc($requeteid);

    if (isset($_POST['postCom'])) {
    $_SESSION['id']=$result['id'];
        if (empty($_SESSION['id'])) {
        echo "<p> veuillez vous inscrire ou vous connectez </p>";
        }
        else{ 
            $com=addslashes($_POST['com']);
            $requete=mysqli_query($bdd,"INSERT INTO `commentaires`(`id`,`commentaire`,`id_utilisateur`,`date`) VALUES (NULL,'$com','$_SESSION[id]',NOW())");
            header('location:' . 'livre-or.php');
        }
    }
}

?>