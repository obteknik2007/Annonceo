<div class="row">
    <div class="col-md-12">                 
    
    </div>
            </div>
            <div class="clearfix"></div>
            <hr style="border-color:#000;margin-top:10px;">
            
            <div class="row">
                <div class="col-md-12">  
                        <?php 
                        echo 'Départements sélectionnés : ';
                        /*if(isset($_GET)){
                            echo '<small>Département sélectionné : '.$liste_depts.'</small>';
                        } else { //non connecté
                            echo '<small>Département(s) sélectionné(s) : <span id="list_dept_selected"></span></small>';
                        } */?>
                        <hr style="border-color:#000;margin-bottom:10px;">
                </div>
            </div>
            
            <div class="row" id="content_carte">
                <!-- SELECT DEPARTEMENTS -->
                <div class="col-md-4">
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

                <!-- CARTE DE FRANCE DES DEPARTEMENTS -->
                <div class="col-md-8" id="carte"> 
                    <div class="form-group">
                        <button style="color:yellow" type="submit" class="btn btn-primary btn-block" id="dept_search">Lancer la recherche à partir de département(s)</button>
                    </div>
                    <div id='container-map-selector'></div>
                </div>
            </div> <!-- fin row -->            
            </form>
                </div> <!-- fin col-md-8 -->
                <!--*** FIN CONTENT AJAX ***-->
                