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
    /*
    echo '<pre>';
    var_dump($_SESSION);
    var_dump($_COOKIE) 
    echo '</pre>';*/
?>

<div class="row">
    <div class="col-md-4"> <!-- BLOC GAUCHE -->
        <div class="box-content" style="min-height: 602px;">      
            <!-- Texte -->
            <p><span id="index_nb_annonces"><?=$nb_annonces ?> annonces</span> disponibles sur <span id="index_marque">Annonceo</span> !</p>
            
            <hr>

            <!-- slider publicitaire -->
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                    </ol>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <div class="item active">
                            <img src="assets/img/280x125_slider_pub1.png" alt="Encart 1">
                            <div class="carousel-caption"></div>
                        </div>
                        <div class="item">
                            <img src="assets/img/280x125_slider_pub2.png" alt="Encart 2">
                            <div class="carousel-caption"></div>
                        </div>
                        <div class="item">
                            <img src="assets/img/280x125_slider_pub3.png" alt="Encart 3">
                            <div class="carousel-caption"></div>
                        </div>
                    </div>

                    <!-- Controls -->
                    <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>
                </div> <!-- fin carousel -->

            <!-- encarts fixes -->
            <img id="index_encart_pub1" src="assets/img/300x100_Encart_publicitaire 1.png" alt="Encart publicitaire1" class="img-responsive">
            <img id="index_encart_pub2" src="assets/img/300x100_Encart_publicitaire 2.png" alt="Encart publicitaire1" class="img-responsive">
            <img id="index_encart_pub3" src="assets/img/300x100_Encart_publicitaire 3.png" alt="Encart publicitaire1" class="img-responsive">
        </div> <!-- fin col-md-4 -->
    </div> <!-- fin box-content -->

    <div class="col-md-8"> <!-- BLOC DROIT -->
        <div class="box-content"> 
            <p>
                <span id="index_titre_carte">Choisissez votre département...</span>
                <button id="index_btn_publier" class="btn btn-primary pull-right btn-sm"><a style="color:yellow;text-decoration:none;" href="php/front/publier_annonce.php">Publier une annonce</a></button>
            </p>
            <hr><br>
            <div id="map" style="height: 530px;margin: 0 auto;"></div>
        </div>
    </div> <!-- fin col-md-8 -->
</div> <!-- fin row -->

<?php require_once('php_inc/footer.php'); ?>