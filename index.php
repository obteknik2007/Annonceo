<?php require_once('php_inc/init.php');

//header
require_once('php_inc/header.php');
//-------------------------//
//nb d'annnonces en stock
$req = $pdo->query("SELECT COUNT(id_annonce) FROM annonce");
$res = $req->fetch(PDO::FETCH_ASSOC);
$nb_annonces = $res['COUNT(id_annonce)'];

    /*
    echo '<pre>';
    var_dump($_SESSION);
    var_dump($_COOKIE) 
    echo '</pre>';*/

//je parcoure $_GET pour récupérer les codes dept
if(isset($_GET)){
    $url_get = $_SERVER['QUERY_STRING'];
    $liste_depts = implode(",",$_GET);
}
?>

<div class="row" style="margin-bottom:15px;">
    <div class="col-md-4"> <!-- BLOC GAUCHE -->
        <div class="box-content" style="min-height: 644px;">      
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

            <!-- encarts fixes : http://via.placeholder.com/300x100/ffffff/000000?text=Encart+publicitaire+1 -->
            <img class="index_encart_pub center-block" src="assets/img/300x100_Encart_publicitaire 1.png" alt="Encart publicitaire1" class="img-responsive">
            <img class="index_encart_pub center-block" src="assets/img/300x100_Encart_publicitaire 2.png" alt="Encart publicitaire1" class="img-responsive">
            <img class="index_encart_pub center-block" src="assets/img/300x100_Encart_publicitaire 3.png" alt="Encart publicitaire1" class="img-responsive">
        </div> <!-- fin col-md-4 -->
    </div> <!-- fin box-content -->

    <div class="col-md-8"> <!-- BLOC DROIT -->
        <div class="row">
            <div class="col-md-12">

                <ul class="nav nav-pills">
                    <!-- Btn Toute la France -->
                    <li class="active" id="index_btn_france"><a href="#">Home</a></li>
                    <!--<li><button class="btn btn-primary">Recherche France</button></li>-->
                    <!-- Btn Régions -->
                    <li><a href="#" id="index_btn_region">Recherche par régions</a></li>

                    <!-- Btn  Départements -->
                    <li><a href="#" id="index_btn_dept">Recherche par départements</a></li>
                </ul>
            </div>
        </div>

        <div class="box-content" id="content_index"> 
            
        </div> <!-- fin content_index -->
        </div>
<?php require_once('php_inc/footer.php'); ?>
</body>
</html>