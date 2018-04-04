<?php
require_once('../../init.php');
DEFINE('SESSION_ENTITY_ID',23);

$option_select_graph = secure_field($_POST['option_select_graph']);

switch($option_select_graph){
    case 'select_mbe_graph1' :
        $idmbe = SESSION_ENTITY_ID;
        $sqlGraph1 = "SELECT
        MONTH(CL.created_at) AS MOIS_CL_CREATED_AT,
        COUNT(CL.id) AS COUNT_MBE_CL

        FROM  membres_entity MBE
        INNER JOIN clients CL ON CL.id_membres_entity = MBE.id
        INNER JOIN entites ENT ON ENT.idclient = CL.id
        WHERE MBE.id = ? AND ENT.iddossier is NULL
        GROUP BY MOIS_CL_CREATED_AT";
        $reqGraph1 = $bdd->prepare($sqlGraph1);
        $reqGraph1->execute(array($idmbe));
        $nb = $reqGraph1->rowCount();

//si pas de r�sultat,je renvoie 'ko', sinon la liste des dossiers
        $data1 = [];
        if($nb==0){
            array_push($data1,'ko');
        } else {

            //Attendu : $listGraph1 = [[1,1], [2,2], [3,10], [4,4], [5,5], [6,6], [7,7], [8,8], [9,9], [10,10], [11,11], [12,12]];
            while ($resGraph1 = $reqGraph1->fetch()) {
                //array_push($listGraph1 ,'['.$resGraph1['MOIS_CL_CREATED_AT'].','.$resGraph1['COUNT_MBE_CL'].']');
                $x = $resGraph1['MOIS_CL_CREATED_AT']-1; /* pour index commen�ant � 0 */
                $y = $resGraph1['COUNT_MBE_CL'];
                $data1[] = array($x, $y);
            }
        }
        echo json_encode($data1);
        break;

    case 'select_mbe_graph2' :

        $idmbe = secure_field($_POST['idmbe']);
        $sqlGraph2 = "SELECT
        MONTH(CL.created_at) AS MOIS_CL_CREATED_AT,
        SUM(DOS.montant_ppal) AS SUM_CL_DOS_MONTANT_PPAL

        FROM  membres_entity MBE
        INNER JOIN clients CL ON CL.id_membres_entity = MBE.id
        INNER JOIN entites ENT ON ENT.idclient = CL.id
        INNER JOIN dossiers DOS ON DOS.idclient = CL.id
        WHERE MBE.id = ? AND ENT.iddossier is NULL
        GROUP BY MOIS_CL_CREATED_AT";
        $reqGraph2 = $bdd->prepare($sqlGraph2);
        $reqGraph2->execute(array($idmbe));
        $nb = $reqGraph2->rowCount();

//si pas de r�sultat,je renvoie 'ko', sinon la liste des dossiers
        $data2 = [];
        if($nb==0){
            array_push($data2,'ko');
        } else {

            //Attendu : $listGraph1 = [[1,1], [2,2], [3,10], [4,4], [5,5], [6,6], [7,7], [8,8], [9,9], [10,10], [11,11], [12,12]];
            while ($resGraph2 = $reqGraph2->fetch()) {
                //array_push($listGraph1 ,'['.$resGraph1['MOIS_CL_CREATED_AT'].','.$resGraph1['COUNT_MBE_CL'].']');
                $x = $resGraph2['MOIS_CL_CREATED_AT'];
                $y = $resGraph2['SUM_CL_DOS_MONTANT_PPAL'];
                $data2[] = array($x, $y);
            }
        }
        echo json_encode($data2);
        break;
}
?>
