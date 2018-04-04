<?php
// Nb d'annonces par mois
// recup données du graphe

$sqlGraph1 = "SELECT
MONTH(ANN.created_at) AS MOIS_ANN_CREATED_AT,
COUNT(ANN.id) AS COUNT_ANN
FROM  annonce ANN
GROUP BY MOIS_ANN_CREATED_AT";

$reqGraph1 = $pdo->prepare($sqlGraph1);
$reqGraph1->execute();
$nbEnrgts = $reqGraph1->rowCount();

//si pas de r�sultat,je renvoie 'ko', sinon la liste des dossiers
$data1 = [];
if($nbEnrgts==0){
    array_push($data1,'ko');
} else {
    //Attendu : $listGraph1 = [[1,1], [2,2], [3,10], [4,4], [5,5], [6,6], [7,7], [8,8], [9,9], [10,10], [11,11], [12,12]];
    while ($resGraph1 = $reqGraph1->fetch()) {
        //array_push($listGraph1 ,'['.$resGraph1['MOIS_CL_CREATED_AT'].','.$resGraph1['COUNT_MBE_CL'].']');
        $x = $resGraph1['MOIS_ANN_CREATED_AT']-1; /* pour index commen�ant � 0 */
        $y = $resGraph1['COUNT_ANN'];
        $data1[] = array($x, $y);
    }
}
        
echo json_encode($data1);
?>