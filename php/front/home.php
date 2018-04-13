<?php
require_once('../../php_inc/init.php');
require_once('../../php_inc/header.php');

if(isset($_POST)){
    echo '<div class="alert alert-info">';
    echo '<p>Départements pour filtre = </p>';
    foreach($_POST['depts'] as $valeur){
        
        echo $valeur.'<br>';
    }
    echo '</div>';
}
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
    $annonces_filtrees->execute(array('dept'=> 77));

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
    <h2>Home</h2>

    <hr style="border-color:#647ab7;margin-bottom:15px">
    <div class="row">
        <div class="col-md-10">
            <small>Filtres : Département : <?=77 ?></small>
        </div>
        <div class="col-md-2">
            <small class="pull-right">Nombre de résultats :<?= $annonces_filtrees->rowCount() ?></small>
        </div>
    </div>  

    <div class="row">
        
        <!-- PARTIE GAUCHE / FILTRES DE RECHERCHE -->
        <div class="col-md-4">
            <h4>Filtres</h4>
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
                <small>Filtrer par intervalle le prix : </small><br>
                <b>€ 10</b> <input id="home_filtre_prix" type="text"    value="" data-slider-min="10" data-slider-max="1000" data-slider-step="5" data-slider-value="[250,450]"/> <b>€ 1000</b>
                </div>

                <!-- Possibilités de tri -->
                <div class="form-group home_bloc_filtre">
                <label for="home_tri">Trier les résultats par :</label>
                    <select class="form-control" name="home_tri" id="home_tri">
                        <option value="1">le prix</option>
                        <option value="2">la localisation géographique</option>
                        <option value="3"> la notation du vendeur</option>
                    </select>

                    <small>Tri ascendant/descendant</small>
                    <div>
                        <input type="radio" id="sensChoice1"
                        name="sens_tri" value="asc" checked>
                        <label for="sensChoice1">Ascendant</label>

                        <input type="radio" id="sensChoice2"
                        name="sens_tri" value="desc">
                        <label for="contactChoice2">Descendant</label>
                    </div>

                <!-- Btn filtrer -->
                <button type="submit" class="btn btn-primary center-block"><a style="color:yellow;text-decoration:none;"><span style="color:yellow" class="glyphicon glyphicon-search" aria-hidden="true"></span> Filtrer les annonces</a></button>
            </form>
            </div></div>

            <!-- PARTIE DROITE / LISTE DES ANNONCES -->
            <div class="col-md-8" id="bloc_liste_annonces">
                
                <!-- PARCOURS DES ANNONCES -->
                <?php  while($ligne = $annonces_filtrees->fetch(PDO::FETCH_ASSOC)){ ?>

                <div class="row" style="border:1px dashed lightgrey">
                    <div class="col-md-3">
                        <div class="center-block">
                            <?php $path_image = '';
                            if($ligne['url'] <> ''){
                                $path_image = $ligne['url'];
                            } else {
                                $path_image = '../../assets/img/img_substitut2.png';
                            } ?>
                            <a href="fiche_annonce.php?id_annonce=<?=$ligne['id_annonce'] ?>"> <img class="img-thumbnail img-responsive affiche center-block" src="<?=$path_image ?>" alt="<?=$ligne['titre'] ?>"></a>
                            <?php /*echo 'id annonce = '.$ligne['id_annonce'].' - '.$ligne['cp'].'<br>';
                            echo 'id categorie = '.$ligne['categorie_id'].'<br>';
                            echo 'id membre = '.$ligne['membre_id'].'<br>';
                            echo 'Date d\'enregistrement annonce = '.format_dateheure($ligne['date_enregistrement']);*/ ?>
                        </div>
                    </div> <!--  fin col-md-4 -->
                    
                    <div class="col-md-9 fiche_annonce">
                            <div>
                                <h3 style="background:#eee" class="titre_fiche">
                                    <a href="fiche_annonce.php?id_annonce=<?=$ligne['id_annonce'] ?>"><?=$ligne['titre'] ?></a>
                                </h3>
                                <small style="color:#000;font-weight:bold"><?=$ligne['cp'].' '.$ligne['ville'] ?></small>
                            </div>
                            <?=$ligne['description_longue'] ?><br>
                            <div class="col-md-12">
                                <span><?=$ligne['pseudo'] ?></a></span>
                                <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                <span class="prix_annonce"><?=format_decimal($ligne['prix'],2).' €' ?></span>
                            </div>
                            </div> <!-- fin du col-md-12 -->
               </div> <!-- fin row -->
               
                <?php } ?>
                <h3 class="text-center voir_plus"><a href="#">Voir plus...</a></h3>
            </div>    
    </div><!-- FIN DU ROW -->

<?php require_once('../../php_inc/footer.php');?>
<script>
            // Page Home => filtre par intervalle sur le prix
            $(function(){
                $("#home_filtre_prix").slider({});
            });
        </script>     
    </body>
</html>