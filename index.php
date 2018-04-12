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
                            echo '<small>Département sélectionné - code : '.$_GET['code_dept'];
                        } else { //non connecté
                            echo '<small>Département(s) sélectionné(s) - code : ';
                        }
                        ?>
                        <span id="list_dept_selected_code"></span></small><br>
                    <small>Département(s) sélectionné(s) : <span id="list_dept_selected"></span></small>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-3"> <!-- Liste des départements -->
                <form>
                    <select id="map-selector" name="departements" multiple="multiple">
                        <option value="FR-01">Ain</option>
                        <option value="FR-02">Aisne</option>
                        <option value="FR-03">Allier</option>
                        <option value="FR-04">Alpes-de-Haute-Provence</option>
                        <option value="FR-05">Hautes-Alpes</option>
                        <option value="FR-06">Alpes-Maritimes</option>
                        <option value="FR-07">Ardèche</option>
                        <option value="FR-08">Ardennes</option>
                        <option value="FR-09">Ariège</option>
                        <option value="FR-10">Aube</option>
                        <option value="FR-11">Aude</option>
                        <option value="FR-12">Aveyron</option>
                        <option value="FR-13">Bouches-du-Rhône</option>
                        <option value="FR-14">Calvados</option>
                        <option value="FR-15">Cantal</option>
                        <option value="FR-16">Charente</option>
                        <option value="FR-17">Charente-Maritime</option>
                        <option value="FR-18">Cher</option>
                        <option value="FR-19">Corrèze</option>
                        <option value="FR-2A">Corse-du-sud</option>
                        <option value="FR-2B">Haute-corse</option>
                        <option value="FR-21">Côte-d'or</option>
                        <option value="FR-22">Côtes-d'armor</option>
                        <option value="FR-23">Creuse</option>
                        <option value="FR-24">Dordogne</option>
                        <option value="FR-25">Doubs</option>
                        <option value="FR-26">Drôme</option>
                        <option value="FR-27">Eure</option>
                        <option value="FR-28">Eure-et-Loir</option>
                        <option value="FR-29">Finistère</option>
                        <option value="FR-30">Gard</option> <!-- <option selected value="FR-30">Gard</option> -->
                        <option value="FR-31">Haute-Garonne</option>
                        <option value="FR-32">Gers</option>
                        <option value="FR-33">Gironde</option>
                        <option value="FR-34">Hérault</option>
                        <option value="FR-35">Ile-et-Vilaine</option>
                        <option value="FR-36">Indre</option>
                        <option value="FR-37">Indre-et-Loire</option>
                        <option value="FR-38">Isère</option>
                        <option value="FR-39">Jura</option>
                        <option value="FR-40">Landes</option>
                        <option value="FR-41">Loir-et-Cher</option>
                        <option value="FR-42">Loire</option>
                        <option value="FR-43">Haute-Loire</option>
                        <option value="FR-44">Loire-Atlantique</option>
                        <option value="FR-45">Loiret</option>
                        <option value="FR-46">Lot</option>
                        <option value="FR-47">Lot-et-Garonne</option>
                        <option value="FR-48">Lozère</option>
                        <option value="FR-49">Maine-et-Loire</option>
                        <option value="FR-50">Manche</option>
                        <option value="FR-51">Marne</option>
                        <option value="FR-52">Haute-Marne</option>
                        <option value="FR-53">Mayenne</option>
                        <option value="FR-54">Meurthe-et-Moselle</option>
                        <option value="FR-55">Meuse</option>
                        <option value="FR-56">Morbihan</option>
                        <option value="FR-57">Moselle</option>
                        <option value="FR-58">Nièvre</option>
                        <option value="FR-59">Nord</option>
                        <option value="FR-60">Oise</option>
                        <option value="FR-61">Orne</option>
                        <option value="FR-62">Pas-de-Calais</option>
                        <option value="FR-63">Puy-de-Dôme</option>
                        <option value="FR-64">Pyrénées-Atlantiques</option>
                        <option value="FR-65">Hautes-Pyrénées</option>
                        <option value="FR-66">Pyrénées-Orientales</option>
                        <option value="FR-67">Bas-Rhin</option>
                        <option value="FR-68">Haut-Rhin</option>
                        <option value="FR-69">Rhône</option>
                        <option value="FR-70">Haute-Saône</option>
                        <option value="FR-71">Saône-et-Loire</option>
                        <option value="FR-72">Sarthe</option>
                        <option value="FR-73">Savoie</option>
                        <option value="FR-74">Haute-Savoie</option>
                        <option value="FR-75">Paris</option>
                        <option value="FR-76">Seine-Maritime</option>
                        <option value="FR-77">Seine-et-Marne</option>
                        <option <?=((isset($_GET['code_dept']) 
                            && $_GET['code_dept'] == 'FR-78')) ? 'selected' : ''?> value="FR-78">Yvelines</option>
                        <option value="FR-79">Deux-Sèvres</option>
                        <option value="FR-80">Somme</option>
                        <option value="FR-81">Tarn</option>
                        <option value="FR-82">Tarn-et-Garonne</option>
                        <option value="FR-83">Var</option>
                        <option value="FR-84">Vaucluse</option>
                        <option value="FR-85">Vendée</option>
                        <option value="FR-86">Vienne</option>
                        <option value="FR-87">Haute-Vienne</option>
                        <option value="FR-88">Vosges</option>
                        <option <?=((isset($_GET['code_dept']) 
                            && $_GET['code_dept'] == 'FR-89')) ? 'selected' : ''?> value="FR-89">Yonne</option>
                        <option value="FR-90">Territoire de Belfort</option>
                        <option value="FR-91">Essonne</option>
                        <option value="FR-92">Hauts-de-Seine</option>
                        <option value="FR-93">Seine-Saint-Denis</option>
                        <option value="FR-94">Val-de-Marne</option>
                        <option value="FR-95">Val-d'oise</option>
                        <option value="FR-976">Mayotte</option>
                        <option value="FR-971">Guadeloupe</option>
                        <option value="FR-973">Guyane</option>
                        <option value="FR-972">Martinique</option>
                        <option value="FR-974">Réunion</option>
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