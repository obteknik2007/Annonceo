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

//je récupère le code départt si connecté
/*if(isset($_GET['code_dept'])){
    echo $_GET['code_dept'];
}*/

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

            <!-- encarts fixes : http://via.placeholder.com/300x100/ffffff/000000?text=Encart+publicitaire+1 -->
            <img id="index_encart_pub1" src="assets/img/300x100_Encart_publicitaire 1.png" alt="Encart publicitaire1" class="img-responsive">
            <img id="index_encart_pub2" src="assets/img/300x100_Encart_publicitaire 2.png" alt="Encart publicitaire1" class="img-responsive">
            <img id="index_encart_pub3" src="assets/img/300x100_Encart_publicitaire 3.png" alt="Encart publicitaire1" class="img-responsive">
        </div> <!-- fin col-md-4 -->
    </div> <!-- fin box-content -->

    <div class="col-md-8"> <!-- BLOC DROIT -->
        <div class="box-content"> 
            <p>
                <span id="index_titre_carte">Choisissez votre département...</span>
                <button id="index_btn_publier" class="btn btn-primary pull-right btn-sm"><a style="color:yellow;text-decoration:none;" href="php/front/publier_annonce.php"><span style="color:yellow" class="glyphicon glyphicon-edit" aria-hidden="true"></span> Je publie mon annonce</a></button>
            </p>
            <hr>
            <br>
            <div class="row">
                <div class="col-md-12"> 
                    
                        <?php 
                        if(isset($_GET['code_dept'])){
                            echo 'Département sélectionné - code : '.$_GET['code_dept'].'</br>';
                            echo 'Département sélectionné : '.$_GET['code_dept'];
                        } else { //non connecté
                            echo 'Département(s) sélectionné(s) - code : <span id="list_dept_selected_code"></span><br>';
                            echo 'Département(s) sélectionné(s) : <span id="list_dept_selected"></span>';
                        }
                        ?>
                        
                    
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-3"> <!-- Liste des départements -->
                <form>
                    <select id="map-selector" name="departements" multiple="multiple">
                       
                       <?php
                        $tab_dept = array();
                        $tab_dept = [
                            'FR-01' => 'Ain',
                            'FR-02' => 'Aisne',
                            'FR-03' => 'Allier',
                            'FR-04' => 'Alpes-de-Haute-Provence'
                        ];
                        //$tab_dept_lg = count($tab_dept);
                        foreach($tab_dept as $code => $name_dept){ ?>
                            <option <?php if(isset($_GET['code_dept']) 
                            && $_GET['code_dept'] == $code){ echo 'selected'; } else {echo '';} ?> value="<?=$code ?>"><?=$name_dept ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-md-9" id="carte"> <!-- Carte des départements -->
                    <div id='container-map-selector'></div>
                </div>
            </div> <!-- fin row -->
            <!--<div id="map" style="height: 530px;margin: 0 auto;"></div>-->
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block" id="dept_search">Lancer la recherche</button>
            </div>
            </div>
            </form>
    </div> <!-- fin col-md-8 -->
</div> <!-- fin row -->

<?php require_once('php_inc/footer.php'); ?>