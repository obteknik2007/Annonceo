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
        <div class="box-content"> 
            <p>
                <span id="index_titre_carte">Choisissez votre département...</span>
                <button id="index_btn_publier" class="btn btn-primary pull-right btn-sm"><a style="color:yellow;text-decoration:none;" href="php/front/publier_annonce.php"><span style="color:yellow" class="glyphicon glyphicon-edit" aria-hidden="true"></span> Je publie mon annonce</a></button>
            </p>
            <div class="clearfix"></div>
            <hr style="border-color:#000;margin-top:10px;">
            
            <div class="row">
                <div class="col-md-12">  
                        <?php if(isset($_GET)){
                            echo '<small>Département sélectionné : '.$liste_depts.'</small>';
                        } else { //non connecté
                            echo '<small>Département(s) sélectionné(s) : <span id="list_dept_selected"></span></small>';
                        } ?>
                        <hr style="border-color:#000;margin-bottom:10px;">
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-4"> <!-- Liste des départements -->
                    <form method="POST" action="php/front/home.php">
                
                    <select id="map-selector" name="depts[]" multiple="multiple">
                       <?php $tab_dept = array();
                        $tab_dept = [
                            '01' => 'Ain',
                            '02' => 'Aisne',
                            '03' => 'Allier',
                            '04' => 'Alpes-de-Haute-Provence',
                            '05' => 'Hautes-Alpes',
                            '06' => 'Alpes-Maritimes',
                            '07' => 'Ardèche',
                            '08' => 'Ardennes',
                            '09' => 'Ariège',
                            '10' => 'Aube',
                            '11' => 'Aude',
                            '12' => 'Aveyron',
                            '13' => 'Bouches-du-Rhône',
                            '14' => 'Calvados',
                            '15' => 'Cantal',
                            '16' => 'Charente',
                            '17' => 'Charente-Maritime',
                            '18' => 'Cher',
                            '19' => 'Corrèze',
                            '2A' => 'Corse-du-sud',
                            '2B' => 'Haute-corse',
                            '21' => 'Côte-d\'or',
                            '22' => 'Côtes-d\'armor',
                            '23' => 'Creuse',
                            '24' => 'Dordogne',
                            '25' => 'Doubs',
                            '26' => 'Drôme',
                            '27' => 'Eure',
                            '28' => 'Eure-et-Loir',
                            '29' => 'Finistère',
                            '30' => 'Gard',
                            '31' => 'Haute-Garonne',
                            '32' => 'Gers',
                            '33' => 'Gironde',
                            '34' => 'Hérault',
                            '35' => 'Ile-et-Vilaine',
                            '36' => 'Indre',
                            '37' => 'Indre-et-Loire',
                            '38' => 'Isère',
                            '39' => 'Jura',
                            '40' => 'Landes',
                            '41' => 'Loir-et-Cher',
                            '42' => 'Loire',
                            '43' => 'Haute-Loire',
                            '44' => 'Loire-Atlantique',
                            '45' => 'Loiret',
                            '46' => 'Lot',
                            '47' => 'Lot-et-Garonne',
                            '48' => 'Lozère',
                            '49' => 'Maine-et-Loire',
                            '50' => 'Manche',
                            '51' => 'Marne',
                            '52' => 'Haute-Marne',
                            '53' => 'Mayenne',
                            '54' => 'Meurthe-et-Moselle',
                            '55' => 'Meuse',
                            '56' => 'Morbihan',
                            '57' => 'Moselle',
                            '58' => 'Nièvre',
                            '59' => 'Nord',
                            '60' => 'Oise',
                            '61' => 'Orne',
                            '62' => 'Pas-de-Calais',
                            '63' => 'Puy-de-Dôme',
                            '64' => 'Pyrénées-Atlantiques',
                            '65' => 'Hautes-Pyrénées',
                            '66' => 'Pyrénées-Orientales',
                            '67' => 'Bas-Rhin',
                            '68' => 'Haut-Rhin',
                            '69' => 'Rhône',
                            '70' => 'Haute-Saône',
                            '71' => 'Saône-et-Loire',
                            '72' => 'Sarthe',
                            '73' => 'Savoie',
                            '74' => 'Haute-Savoie',
                            '75' => 'Paris',
                            '76' => 'Seine-Maritime',
                            '77' => 'Seine-et-Marne',
                            '78' => 'Yvelines',
                            '79' => 'Deux-Sèvres',
                            '80' => 'Somme',
                            '81' => 'Tarn',
                            '82' => 'Tarn-et-Garonne',
                            '83' => 'Var',
                            '84' => 'Vaucluse',
                            '85' => 'Vendée',
                            '86' => 'Vienne',
                            '87' => 'Haute-Vienne',
                            '88' => 'Vosges',
                            '89' => 'Yonne',
                            '90' => 'Territoire de Belfort',
                            '91' => 'Essonne',
                            '92' => 'Hauts-de-Seine',
                            '93' => 'Seine-Saint-Denis',
                            '94' => 'Val-de-Marne',
                            '95' => 'Val-d\'oise',
                            '976' => 'Mayotte',
                            '971' => 'Guadeloupe',
                            '973' => 'Guyane',
                            '972' => 'Martinique',
                            '974' => 'Réunion'
                        ];
                        
                        foreach($tab_dept as $code => $name_dept){ ?>
                            <option <?php if(isset($_GET) 
                            && in_array($code,$_GET)){ echo 'selected'; } else {echo '';} ?> value="<?='FR-'.$code ?>"><?=$code.'-'.$name_dept ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-md-8" id="carte"> <!-- Carte des départements -->
                    <div class="form-group">
                        <button style="color:yellow" type="submit" class="btn btn-primary btn-block" id="dept_search">Lancer la recherche</button>
                    </div>
                    <div id='container-map-selector'></div>
                </div>
            </div> <!-- fin row -->            
            </form>
    </div> <!-- fin col-md-8 -->
</div> <!-- fin row -->

<?php require_once('php_inc/footer.php'); ?>
</body>
</html>