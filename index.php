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
                <div class="col-md-4"> <!-- Liste des départements -->
                <form>
                    <select id="map-selector" name="departements" multiple="multiple">
                       
                       <?php
                        $tab_dept = array();
                        $tab_dept = [
                            'FR-01' => 'Ain',
                            'FR-02' => 'Aisne',
                            'FR-03' => 'Allier',
                            'FR-04' => 'Alpes-de-Haute-Provence',
                            'FR-05' => 'Hautes-Alpes',
                            'FR-06' => 'Alpes-Maritimes',
                            'FR-07' => 'Ardèche',
                            'FR-08' => 'Ardennes',
                            'FR-09' => 'Ariège',
                            'FR-10' => 'Aube',
                            'FR-11' => 'Aude',
                            'FR-12' => 'Aveyron',
                            'FR-13' => 'Bouches-du-Rhône',
                            'FR-14' => 'Calvados',
                            'FR-15' => 'Cantal',
                            'FR-16' => 'Charente',
                            'FR-17' => 'Charente-Maritime',
                            'FR-18' => 'Cher',
                            'FR-19' => 'Corrèze',
                            'FR-2A' => 'Corse-du-sud',
                            'FR-2B' => 'Haute-corse',
                            'FR-21' => 'Côte-d\'or',
                            'FR-22' => 'Côtes-d\'armor',
                            'FR-23' => 'Creuse',
                            'FR-24' => 'Dordogne',
                            'FR-25' => 'Doubs',
                            'FR-26' => 'Drôme',
                            'FR-27' => 'Eure',
                            'FR-28' => 'Eure-et-Loir',
                            'FR-29' => 'Finistère',
                            'FR-30' => 'Gard',
                            'FR-31' => 'Haute-Garonne',
                            'FR-32' => 'Gers',
                            'FR-33' => 'Gironde',
                            'FR-34' => 'Hérault',
                            'FR-35' => 'Ile-et-Vilaine',
                            'FR-36' => 'Indre',
                            'FR-37' => 'Indre-et-Loire',
                            'FR-38' => 'Isère',
                            'FR-39' => 'Jura',
                            'FR-40' => 'Landes',
                            'FR-41' => 'Loir-et-Cher',
                            'FR-42' => 'Loire',
                            'FR-43' => 'Haute-Loire',
                            'FR-44' => 'Loire-Atlantique',
                            'FR-44' => 'Loiret',
                            'FR-46' => 'Lot',
                            'FR-47' => 'Lot-et-Garonne',
                            'FR-48' => 'Lozère',
                            'FR-49' => 'Maine-et-Loire',
                            'FR-50' => 'Manche',
                            'FR-51' => 'Marne',
                            'FR-52' => 'Haute-Marne',
                            'FR-53' => 'Mayenne',
                            'FR-54' => 'Meurthe-et-Moselle',
                            'FR-55' => 'Meuse',
                            'FR-56' => 'Morbihan',
                            'FR-57' => 'Moselle',
                            'FR-58' => 'Nièvre',
                            'FR-59' => 'Nord',
                            'FR-60' => 'Oise',
                            'FR-61' => 'Orne',
                            'FR-62' => 'Pas-de-Calais',
                            'FR-63' => 'Puy-de-Dôme',
                            'FR-64' => 'Pyrénées-Atlantiques',
                            'FR-65' => 'Hautes-Pyrénées',
                            'FR-66' => 'Pyrénées-Orientales',
                            'FR-67' => 'Bas-Rhin',
                            'FR-68' => 'Haut-Rhin',
                            'FR-69' => 'Rhône',
                            'FR-70' => 'Haute-Saône',
                            'FR-71' => 'Saône-et-Loire',
                            'FR-72' => 'Sarthe',
                            'FR-73' => 'Savoie',
                            'FR-74' => 'Haute-Savoie',
                            'FR-75' => 'Paris',
                            'FR-76' => 'Seine-Maritime',
                            'FR-77' => 'Seine-et-Marne',
                            'FR-78' => 'Yvelines',
                            'FR-79' => 'Deux-Sèvres',
                            'FR-80' => 'Somme',
                            'FR-81' => 'Tarn',
                            'FR-82' => 'Tarn-et-Garonne',
                            'FR-83' => 'Var',
                            'FR-84' => 'Vaucluse',
                            'FR-85' => 'Vendée',
                            'FR-86' => 'Vienne',
                            'FR-87' => 'Haute-Vienne',
                            'FR-88' => 'Vosges',
                            'FR-89' => 'Yonne',
                            'FR-90' => 'Territoire de Belfort',
                            'FR-91' => 'Essonne',
                            'FR-92' => 'Hauts-de-Seine',
                            'FR-93' => 'Seine-Saint-Denis',
                            'FR-94' => 'Val-de-Marne',
                            'FR-95' => 'Val-d\'oise',
                            'FR-976' => 'Mayotte',
                            'FR-971' => 'Guadeloupe',
                            'FR-973' => 'Guyane',
                            'FR-972' => 'Martinique',
                            'FR-974' => 'Réunion'
                        ];
                        
                        foreach($tab_dept as $code => $name_dept){ ?>
                            <option <?php if(isset($_GET['code_dept']) 
                            && $_GET['code_dept'] == $code){ echo 'selected'; } else {echo '';} ?> value="<?=$code ?>"><?=$code.'-'.$name_dept ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-md-8" id="carte"> <!-- Carte des départements -->
                    <div id='container-map-selector'></div>
                </div>
            </div> <!-- fin row -->
            
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block" id="dept_search">Lancer la recherche</button>
            </div>
            </div>
            </form>
    </div> <!-- fin col-md-8 -->
</div> <!-- fin row -->

<?php require_once('php_inc/footer.php'); ?>