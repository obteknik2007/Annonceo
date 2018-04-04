<?php
require_once('php_inc/init.php');

//traitement connexion
//Déconnexion
if(isset($_POST['action']) && $_POST['action'] == 'deconnexion'){
    
    unset($_SESSION['membre']);
    session_destroy();

    //retour ajax
    echo 'ok';
}

//Traitement soumission du formulaire
if(isset($_POST['action']) && $_POST['action'] =='connexion'){ 

    //cryptage du mot de passe saisi pour le comparer au mdp en bdd
    $motdepassecrypte = md5($_POST['mdp_connexion']); 

    // à partir du pseudo et du mdp saisi, je recherche le membre en bdd
    $req_connexion = $pdo->prepare("SELECT * FROM membre WHERE pseudo = :pseudo AND mdp= :mdp");
    $req_connexion->execute(array('pseudo' => $_POST['pseudo_connexion'],'mdp' => $motdepassecrypte));
    
    //si j'ai un résultat, mise en session des infos du membre
    if($req_connexion->rowCount() > 0){ 
        $membre = $req_connexion->fetch(PDO::FETCH_ASSOC);

        //Mise en session des infos user
        $_SESSION['membre'] = $membre;

        //Création du cookie 'se souvenir de moi'
        if(isset($_POST['remember'])){
            setcookie('user_connect',$_SESSION['membre']['id_membre'],time() + 3600 * 24 * 3); //3 jours
        }

        
        //j'informe l'utilisateur 
        if($_SESSION['membre']['statut'] == 1){
            $session->setFlash("Vous êtes maintenant connecté en tant qu'administrateur sur notre site !"); 
        } else {
            $session->setFlash("Vous êtes maintenant connecté sur notre site !"); 
        }
        

        //retour ajax
        echo 'ok';
    } else {
        echo 'KO';
    }
}
?>
