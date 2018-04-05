<?php
require_once('../../php_inc/init.php');
require_once('../../php_inc/header.php');

//if(isset($_GET['dept'])){
    $dept = $_GET['dept'];
    //$dept = substr($_GET['dept'],-2,2);
/*} else {
    $dept = 77;
}*/
$dept = substr($_GET['dept'],-2,2);
//echo $dept;
    $sql_list_annonces = "
    SELECT 
    ANN.id_annonce,
    ANN.date_enregistrement,
    MEM.id_membre,
    MEM.pseudo,
    ANN.cp,ANN.ville,
    ANN.categorie_id,
    ANN.membre_id,
    ANN.titre,ANN.description_longue,ANN.prix,
    PHO.url,MIn(PHO.date_enregistrement)
    FROM annonce ANN
    
    LEFT JOIN photo PHO ON PHO.annonce_id = ANN.id_annonce
    INNER JOIN membre MEM ON MEM.id_membre = ANN.membre_id
    
    WHERE SUBSTR(ANN.cp,1,2) = :dept

    GROUP BY ANN.id_annonce
    ORDER BY ANN.date_enregistrement DESC";

    $annonces_filtrees = $pdo->prepare($sql_list_annonces);
    $annonces_filtrees->execute(array('dept'=>$dept));

    /***************************/
    /* REMPLISSAGE DES FILTRES */
    //CATEGORIES pour lesquelles au-moins 1 annnonce existe
    $sql_filtre_categories ="SELECT 
        CAT.id_categorie,
        CAT.titre 
        FROM categorie CAT
        INNER JOIN annonce ANN ON ANN.id_annonce = CAT.id_categorie";
    $req_filtre_categories = $pdo->prepare($sql_filtre_categories);
    $req_filtre_categories->execute();

    //DEPARTEMENTS pour lesquels au-moins 1 annnonce existe
    $sql_filtre_dept = "SELECT DISTINCT SUBSTR(cp,1,2) FROM annonce ORDER BY SUBSTR(cp,1,2) ASC";
    $req_filtre_dept = $pdo->prepare($sql_filtre_dept );
    $req_filtre_dept->execute();

    //PSEUDO MEMBRES pour lesquels au-moins 1 annnonce existe
    $sql_filtre_membres = "SELECT DISTINCT * 
    FROM membre MEM
    INNER JOIN annonce ANN ON ANN.membre_id = MEM.id_membre    
    GROUP BY MEM.id_membre";
    $req_filtre_membres = $pdo->prepare($sql_filtre_membres);
    $req_filtre_membres->execute(); 

    ?>
    <div class="row">
        <div class="col-md-4"><h2>Home</h2></div>
        <div class="col-md-8">
            <span style="font-size:15px;padding-bottom:0" class="pull-right">Filtres : Département : <?=$_GET['dept'] ?></span>
        </div>
    </div>
    <hr style="border-color:#FFF;margin-bottom:15px">
    <div class="row">
        <div class="col-md-12 text-right">
            <small>Nombre de résultats :<?= $annonces_filtrees->rowCount() ?></small>
        </div>
    </div>    
    <div class="row">
        <div class="col-md-4">

            <form method="post" action="#">
                <!-- Filtre CATEGORIE -->
                <div class="form-group home_bloc_filtre">
                    <label for="home_filtre_categorie">Catégorie</label>
                    <select class="form-control home_css_select" name="home_filtre_categorie" id="home_filtre_categorie">
                        <option value="0">Toutes les catégories</option>
                        <?php
                        while($categorie = $req_filtre_categories->fetch(PDO::FETCH_ASSOC)){
                            echo '<option value="'.$categorie['id_categorie'].'">'.$categorie['titre'].'</option>';
                        } ?>
                    </select>
                </div>

                <!-- Filtre DEPARTEMENT -->
                <div class="form-group home_bloc_filtre">
                    <label for="home_filtre_dept">Département</label>
                    <select class="form-control home_css_select" name="home_filtre_dept" id="home_filtre_dept">
                        <option value="0">Toutes les départements</option>
                        <?php
                        while($dept = $req_filtre_dept->fetch(PDO::FETCH_ASSOC)){
                            echo '<option value="'.$dept['SUBSTR(cp,1,2)'].'">'.$dept['SUBSTR(cp,1,2)'].'</option>';
                        } ?>
                    </select>
                </div>
            
                <!-- Filtre MEMBRE -->
                <div class="form-group home_bloc_filtre">
                    <label for="home_filtre_membre">Membre</label>
                    <select class="form-control home_css_select" name="home_filtre_membre" id="home_filtre_membre">
                        <option value="0">Toutes les membres</option>
                        <?php
                        while($membre = $req_filtre_membres->fetch(PDO::FETCH_ASSOC)){
                            echo '<option value="'.$membre['id_membre'].'">'.$membre['pseudo'].'</option>';
                        } ?>
                    </select>
                </div>

                <!-- Filtre PRIX -->
                <div class="form-group home_bloc_filtre">
                <label for="Points">Prix</label>
                    <input type="range" id="rangeValue" name="points" min="0" max="100" onchange="rangevalue.value=value">
                    <output id="rangevalue"></output>   
                </div>

                <button type="submit" class="btn btn-primary center-block"><a style="color:yellow;text-decoration:none;">Filtrer les annonces</a></button>
            </form>
        </div>
            <div class="col-md-8" id="bloc_liste_annonces">
                <!-- Département filtré par défaut-->

                <!-- Tri par prix ASC/DESC -->
                <form id="form_tri_prix" method ="post" action="">
                    <select class="form-control home_css_select" name="home_filtre_prix" id="home_filtre_prix">
                        <option value="1">Trier par prix (du moins cher au plus cher)</option>
                        <option value="2">Trier par prix (du plus cher au moins cher)</option>
                    </select>
                </form>
                <?php
                
                /* AFFICHAGE DES ANNONCES */
                while($ligne = $annonces_filtrees->fetch(PDO::FETCH_ASSOC))
                {
                
               echo '<div class="row">';
                    echo'<div class="col-md-3">';
                        echo '<div class="center-block">';
                            $path_image = '';
                            if($ligne['url'] <> ''){
                                $path_image = $ligne['url'];
                            } else {
                                $path_image = '../../assets/img/img_substitut2.png';
                            }
                            echo '<a href="fiche_annonce.php?id_annonce='.$ligne['id_annonce'].'"> <img class="img-thumbnail img-responsive affiche center-block" src="'.$path_image.'" alt="'.$ligne['titre'].'"></a>';
                            /*echo 'id annonce = '.$ligne['id_annonce'].' - '.$ligne['cp'].'<br>';
                            echo 'id categorie = '.$ligne['categorie_id'].'<br>';
                            echo 'id membre = '.$ligne['membre_id'].'<br>';
                            echo 'Date d\'enregistrement annonce = '.format_dateheure($ligne['date_enregistrement']);*/
                            echo'</div>';
                            echo'</div>';/* fin col-md-4*/
                    
                    echo '<div class="col-md-9 fiche_annonce">
                            <div>
                                <h3 style="background:#eee" class="titre_fiche"><a href="fiche_annonce.php?id_annonce='.$ligne['id_annonce'].'">'.$ligne['titre'].'</a></h3>
                                <small style="color:#000;font-weight:bold">'.$ligne['cp'].' - '.$ligne['ville'].'</small>
                            </div>';
                    echo $ligne['description_longue'].'<br>';
                        echo '<div class="col-md-12" style="background: lightblue">
                                <span>'.$ligne['pseudo'].'</a></span>
                                <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                <span class="prix_annonce">'.format_decimal($ligne['prix'],2).' €</span>
                            </div>
                            </div>';/* fin du col-md-12 */
               echo '</div>';/* fin de la row */
               
                }
                echo'<h3 class="text-center voir_plus"><a href="#">Voir plus...</a></h3>';
            ?>
            </div>    
    </div><!-- FIN DU ROW -->

<?php require_once('../../php_inc/footer.php');?>