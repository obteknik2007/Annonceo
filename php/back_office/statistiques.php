<?php

require_once('../../php_inc/init.php');
require_once('../../php_inc/header.php');

$resul=$pdo->query('select count(id_annonce), mem.prenom,mem.nom,mem.id_membre,ann.membre_id
from membre mem,
annonce ann
where ann.membre_id=mem.id_membre
group by prenom
order by id_annonce asc
');

$resul1=$pdo->query('SELECT count(id_categorie) as nb_annonces, cat.titre,cat.id_categorie,ann.categorie_id from 
categorie cat,
annonce ann
where cat.id_categorie=ann.categorie_id
group by id_categorie');

?>

 <div class="row">
    <div class="col-md-6">
            <h2 class="stat">Remise à zéro du site</h2>
            <hr>
            <small>Vidage des tables d'annonces</small><br><br>
            <p>En confirmant l'exécution du bouton ci-dessous, on vide :</p>

            <ul>
                <li>la table des notes des membres</li>
                <li>la table des commentaires</li>
                <li>la table des photos + suppressions des photos physiques</li>
                <li>la tables des annonces</li>
                <li>la table des catégories</li>
                <li>la table des membres (hors pseudo admin)</li>
            </ul>

            <button class="btn btn-primary" id="clean_environnement">Nettoyer l'environnement</button>
    </div>
    <div class="col-md-6">
        <h2 class="stat">Statistiques</h2>
        <hr>
        <h3 class="publie">Membres ayant publié le plus d'annonces:</h3>
        <ul class="list-group publie">
            <?php
            $i=1;
                while($membres=$resul->fetch(PDO::FETCH_ASSOC))
                {
                    echo'<li class="list-group-item">'.$i.' - '.$membres['prenom'].' '.$membres['nom'].' a publié '.$membres['count(id_annonce)'].' annonce(s)</li>';
                    $i++;
                }
            ?>
        </ul>

        <h3 class="publie">Categories contenant le plus d'annonces</h3>
        <ul class="list-group publie">
            <?php
            $i=1;
                while($annonces=$resul1->fetch(PDO::FETCH_ASSOC))
                {
                    echo'<li class="list-group-item">'.$i.' - '.$annonces['titre'].' contient '.$annonces['nb_annonces'].' annonce(s)</li>';
                    $i++;
                }
            ?>
        </ul>

        <p>Nb de clients créés</p>
        <div id="content_graph1"></div>

    <script>
        $(function(){
        // GRAPHE 1
        var content_graph1 = $('#content_graph1');
        content_graph1.css({'width':'300px','height':'200px'});
        get_home_graph1(content_graph1);
        });
    </script>
</div> 
<?php require_once('../../php_inc/footer.php'); ?>