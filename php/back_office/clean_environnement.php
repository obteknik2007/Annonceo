<?php require_once('../../php_inc/init.php');

/*
                <li>la table des notes des membres</li>
                <li>la table des commentaires</li>
                <li>la table des photos + suppressions des photos physiques</li>
                <li>la tables des annonces</li>
                <li>la table des catégories</li>
                <li>la table des membres (hors pseudo admin)</li>
*/

$tableAnettoyer = ['note','commentaire','photo','annonce','categorie'];

//suppression des membres hormis pseudo = admin
foreach($tableAnettoyer as $key=>$value){
    $sql = "DELETE FROM $value";
    $req = $pdo->prepare($sql);
    $req->execute();
}

//suppressions des photos physiques deans le répertoire 'photos'
$sql2 = "DELETE FROM membre WHERE pseudo != :pseudo";
$req2 = $pdo->prepare($sql2);
$req2->execute(array('pseudo' => 'admin'));

//retour ajax
echo 'ok';
?>