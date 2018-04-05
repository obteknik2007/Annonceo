<?php require_once('php_inc/init.php');

//header
require_once('php_inc/header.php');
//-------------------------//
//nb d'annnonces en stock
$req = $pdo->query("SELECT COUNT(id_annonce) FROM annonce");
$res = $req->fetch(PDO::FETCH_ASSOC);
$nb_annonces = $res['COUNT(id_annonce)'];
?>
<?php 
        //echo '<pre>';
        //var_dump($_SESSION);
        //var_dump($_COOKIE) 
        //echo '</pre>';?>

<div class="row">
    <div class="col-md-4"> <!-- BLOC GAUCHE -->
        <div class="box-content" style="width: 100%; height: 571px;">      
            <!-- Texte -->
            <p><span id="index_nb_annonces"><?=$nb_annonces ?> annonces</span> disponibles sur <span id="index_marque">Annonceo</span> !</p>
            
            <hr>
            <!--<div class="clearfix"></div>-->

            <!-- encart publicitaire http://via.placeholder.com/300x100?text=encart_publicitaire1 -->
            <div class="center-block">
                <div class="center-block" style="height:130px;width:300px;background:yellow">Slider publicitaire</div>
                <img id="index_encart_pub1" src="assets/img/300x100_Encart_publicitaire 1.png" alt="Encart publicitaire1" class="img-responsive center-block">
                <img id="index_encart_pub2" src="assets/img/300x100_Encart_publicitaire 2.png" alt="Encart publicitaire1" class="img-responsive center-block">
                <img id="index_encart_pub3" src="assets/img/300x100_Encart_publicitaire 3.png" alt="Encart publicitaire1" class="img-responsive center-block">
            </div>

        </div>
    </div>
    <div class="col-md-8"> <!-- BLOC DROIT -->
        <div class="box-content"> 
            <p><span id="index_titre_carte">Choisissez votre département...</span></p>
            <hr><br>
            <div id="map" style="width: 100%; height: 500px;margin: 0 auto;"></div>
        </div>
    </div>
</div> <!-- fin row -->





<?php 
//footer
require_once('php_inc/footer.php');
?>