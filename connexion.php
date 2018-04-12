<?php
require_once('php_inc/init.php');

// Traitement DECONNEXION
if(isset($_POST['action']) && $_POST['action'] == 'deconnexion'){
    
    unset($_SESSION['membre']);
    session_destroy();

    //retour ajax
    echo 'ok';
}

// Traitement FORMULAIRE DE CONNEXION
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

        //j'historise la date de dernière connexion = celle en cours dans 'last_login'
        $dh_login = date('Y-m-d H:i:s');
        $sql = "UPDATE membre SET last_login=:last_login WHERE id_membre=:id_membre";
        $req = $pdo->prepare($sql);
        $req->execute(array('last_login' => $dh_login, 'id_membre' => $_SESSION['membre']['id_membre']));

        //j'informe l'utilisateur 
        if($_SESSION['membre']['statut'] == 1){
            $session->setFlash("Vous êtes maintenant connecté en tant qu'administrateur sur notre site !"); 
        } else {
            $session->setFlash("Vous êtes maintenant connecté sur notre site !"); 
        }
        
        //retour ajax
        echo 'ok-'.$membre['cp'];
    } else {
        echo 'KO';
    }
}
?>