<?php require_once('init.php');
//compteurs tables admin
//membres
$sql1 = "SELECT COUNT(id_membre) FROM membre";
$req1 = $pdo->prepare($sql1);
$req1->execute();
$res1 = $req1->fetch();
$nbMembres = $res1['COUNT(id_membre)'];

//catégories
$sql2 = "SELECT COUNT(id_categorie) FROM categorie";
$req2 = $pdo->prepare($sql2);
$req2->execute();
$res2 = $req2->fetch();
$nbCategories = $res2['COUNT(id_categorie)'];

//annonces
$sql3 = "SELECT COUNT(id_annonce) FROM annonce";
$req3 = $pdo->prepare($sql3);
$req3->execute();
$res3 = $req3->fetch();
$nbAnnonces = $res3['COUNT(id_annonce)'];

//commentaires
$sql4 = "SELECT COUNT(id_commentaire) FROM commentaire";
$req4 = $pdo->prepare($sql4);
$req4->execute();
$res4 = $req4->fetch();
$nbCommentaires = $res4['COUNT(id_commentaire)'];

//notes
$sql5 = "SELECT COUNT(id_note) FROM note";
$req5 = $pdo->prepare($sql5);
$req5->execute();
$res5 = $req5->fetch();
$nbNotes = $res5['COUNT(id_note)'];

//connexions
$sql6 = "SELECT COUNT(id_connexion) FROM connexion";
$req6 = $pdo->prepare($sql6);
$req6->execute();
$res6 = $req6->fetch();
$nbConnexions = $res6['COUNT(id_connexion)'];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Annonceo | Home</title>
    <!-- favicon -->
    <link rel="apple-touch-icon" sizes="57x57" href="assets/img/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="assets/img/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="assets/img/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="assets/img/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="assets/img/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="assets/img/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="assets/img/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="assets/img/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicon/favicon-16x16.png">
    <link rel="manifest" href="assets/img/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="assets/img/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <!-- css libs -->
    <link rel="stylesheet" href="<?=RACINE_SITE ?>/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=RACINE_SITE ?>/assets/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="<?=RACINE_SITE ?>/assets/css/animate.min.css">
    <link rel="stylesheet" href="<?=RACINE_SITE ?>/assets/css/toastr.min.css">
    <link rel="stylesheet" href="<?=RACINE_SITE ?>/assets/css/pace_theme_1.css">
    <link rel="stylesheet" href="<?=RACINE_SITE ?>/assets/css/jquery-jvectormap-2.0.3.css">
    <link rel="stylesheet" href=" https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.0.0/css/bootstrap-slider.min.css">
   
    <!-- css perso -->
    <link rel="stylesheet" href="<?=RACINE_SITE ?>/assets/css/style.css">
</head>
<body>
    <header>
        <nav id="barre" class="navbar navbar-inverse">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="index.php" class="navbar-brand"><span class="menu_txt">Annonceo</span></a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                    <ul class="nav navbar-nav">
                    <li><a href="index.php"><span style="color:#FFF;" class="glyphicon glyphicon-home menu_txt" aria-hidden="true"></span><span class="sr-only">(current)</span></a></li>
                        <li>
                    <li class="active menu_txt" id="nav_qui_sommesnous"><a href="php/front/qui_sommesnous.php" >Qui sommes-nous</a></li>
                        <li>
                            <form id="index_form_search" class="navbar-form">
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">
                                        <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                                        </span>
                                    <input type="text" id="index_search" name="index_search" class="form-control input-sm" placeholder="Recherche..." aria-describedby="basic-addon1">
                                </div>
                            </form>
                        </li>
                    </ul>

                    <!-- NAVBAR RIGHT -->
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                        <a href="#" class="dropdown-toggle" style="text-shadow:1px 2px 3px rgba(0,0,0, 0.5);" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> Espace membre <span class="caret"></span></a>
                        <ul class="dropdown-menu" id="espace-membres">
                            <?php
                                if(!estConnecte()){
                                    echo '<li class="menu_txt"><a href="#ModalFormInscription" data-toggle="modal"><span class="glyphicon glyphicon-edit pull-right glyph_menu_admin" aria-hidden="true"></span>S\'inscrire</a></li>';

                                    echo '<li role="separator" class="divider"></li>';

                                    echo '<li class="menu_txt"><a href="#ModalFormConnexion" data-toggle="modal"><span class="glyphicon glyphicon-log-in pull-right glyph_menu_admin" aria-hidden="true"></span>Se connecter</a></li>';
                                } else {
                                    echo '<li class="menu_txt"><a href="/annonceo/profil.php"><span class="glyphicon glyphicon-user pull-right glyph_menu_admin" aria-hidden="true"></span>Profil</a></li>';
                                    echo '<li role="separator" class="divider"></li>';
                                    echo '<li class="menu_txt"><a href="#" id="deconnexion"><span class="glyphicon glyphicon-log-out pull-right glyph_menu_admin" aria-hidden="true"></span>Se déconnecter</a></li>';
                                }
                            ?>
                        </ul>
                        </li>
                        <?php if(estConnecteEtAdmin()){ ?>
                        <li class="dropdown">
                        <a href="#" class="dropdown-toggle" style="text-shadow:1px 2px 3px rgba(0,0,0, 0.5);" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-lock"></span> Administration <span class="caret"></span></a>
                        <ul class="dropdown-menu" id="admin-items" aria-labelledby="dropdownMenuDivider">
                            
                                <li class="menu_txt"><a href="/annonceo/php/back_office/gestion_membres.php"><span class="badge pull-right badge_menu_admin"> <?=$nbMembres ?> </span><span class="glyphicon glyphicon-user pull-right glyph_menu_admin" aria-hidden="true"></span> Gestion des membres</a></li>

                                <li class="menu_txt"><a href="/annonceo/php/back_office/gestion_categories.php"><span class="badge pull-right badge_menu_admin"> <?=$nbCategories ?> </span><span class="glyphicon glyphicon-folder-open pull-right glyph_menu_admin" aria-hidden="true"></span> Gestion des catégories</a></li>

                                <li class="menu_txt"><a href="/annonceo/php/back_office/gestion_annonces.php"><span class="badge pull-right badge_menu_admin"> <?=$nbAnnonces ?> </span><span class="glyphicon glyphicon-list-alt pull-right glyph_menu_admin" aria-hidden="true"></span> Gestion des annonces</a></li>

                                <li class="menu_txt"><a href="/annonceo/php/back_office/gestion_commentaires.php"><span class="badge pull-right badge_menu_admin"> <?=$nbCommentaires ?> </span><span class="glyphicon glyphicon-pencil pull-right glyph_menu_admin" aria-hidden="true"></span> Gestion des commentaires</a></li>

                                <li class="menu_txt"><a href="/annonceo/php/back_office/gestion_notes.php"><span class="badge pull-right badge_menu_admin"> <?=$nbNotes ?> </span><span class="glyphicon glyphicon-star pull-right glyph_menu_admin" aria-hidden="true"></span> Gestion des notes</a></li>

                                <li class="menu_txt"><a href="/annonceo/php/back_office/histo_connexion.php"><span class="badge pull-right badge_menu_admin"> <?=$nbConnexions ?> </span><span class="glyphicon glyphicon-time pull-right glyph_menu_admin" aria-hidden="true"></span> Historique des connexions</a></li>            
                                
                                <li role="separator" class="divider"></li>

                                <li class="menu_txt"><a href="/annonceo/php/back_office/statistiques.php"><span  style="color:#647ab7" class="glyphicon glyphicon-stats pull-right" aria-hidden="true"></span> Statistiques/Nettoyage</a></li>
                            <?php } ?>
                        </ul>
                        </li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container -->
        </nav>
    </header>
    
    <div class="container">
        <?php if(estConnecte()){
            //recup dh de dernière connexion du membre connecté
            $sql = "SELECT last_login FROM membre WHERE id_membre =:id_membre";
            $req = $pdo->prepare($sql);
            $req->execute(array('id_membre' => $_SESSION['membre']['id_membre']));
            $res = $req->fetch();

            $dh_last_login = $res['last_login'];
            echo '<span id="index_login">Membre connecté : <strong>'.$_SESSION['membre']['prenom'].' '.$_SESSION['membre']['nom'].'</strong> - Date heure de dernière connexion : <strong>'.format_dateheure($dh_last_login).'</strong> '; 
                        
            echo'<span class="pull-right" style="color: dodgerblue;border-bottom:1px solid #000"><span id="index_nb_annonces_ggl">n annonces</span> disponibles dans un rayon de 30 kms de chez vous</span> !</span>';
            echo '</span><hr style="margin-bottom:15px">';
        } ?>

        <!-- Messages Flash -->
            <?php if(isset($_SESSION['flash'])){
            echo '<div class="alert alert-success">';
            $session->flash();
            echo '</div>';
        } ?>
    </div> <!-- fin container -->
    
    <!-- CONTENU DU SITE -->
    <div id="contenu_ppal" class="container"> 

<!--  ************************************************************************************************** -->
    <!-- MODAL INSCRIPTION -->
<div class="modal fade" id="ModalFormInscription" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h4 class="modal-title">S'inscrire</h4>
            </div>
            <div class="modal-body">
                <!-- erreurs form-->
                <?=$contenu; ?>

                <!-- FORMULAIRE D'INSCRIPTION -->
                <div id="inscription_erreurs"></div>
                <!-- zone erreurs -->
                <form novalidate method="post" class="form-horizontal" action="">
                    <!-- pseudo -->
                    <div class="form-group">
                        <label for="pseudo_inscription" class="col-sm-4 control-label">Pseudo* :</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="pseudo_inscription" name="pseudo_inscription" placeholder="Votre pseudo..." value="<?=$_POST['pseudo_inscription'] ?? '' ?>" required autocus>
                        </div>
                        <div class="col-sm-1">
                            <span class="glyphicon glyphicon-question-sign glyphicon-help" title="Taille comprise entre 1 et 20  caractères"></span>
                        </div>
                    </div>

                    <!-- mot de passe -->
                    <div class="form-group">
                        <label for="mdp_inscription" class="col-sm-4 control-label">Mot de passe* :</label>
                        <div class="col-sm-7">
                            <input type="password" class="form-control" id="mdp_inscription" name="mdp_inscription" placeholder="Votre mot de passe..." required >
                        </div>
                        <div class="col-sm-1">
                            <span class="glyphicon glyphicon-question-sign glyphicon-help" title="composé de..."></span>
                        </div>
                    </div>

                    <!-- civilité -->
                    <div class="form-group">
                        <label for="civilite" class="col-sm-4 control-label">Civilité* :</label>
                        <div class="col-sm-7 pull-left">
                            Monsieur <input type="radio" name="civilite" value="m" <?=((isset($_POST['civilite']) 
                            && $_POST['civilite'] == 'm')) || !isset($_POST['civilite']) ? 'checked' : ''?>>
                                Madame <input type="radio" name="civilite" value="f" <?=((isset($_POST['civilite']) 
                            && $_POST['civilite'] == 'f')) ? 'checked' : ''?>>
                        </div>
                    </div>

                    <!-- prénom -->
                    <div class="form-group">
                        <label for="prenom" class="col-sm-4 control-label">Prénom* :</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Votre prénom..." value="<?=$_POST['prenom'] ?? '' ?>">
                        </div>
                        <div class="col-sm-1">
                            <span class="glyphicon glyphicon-question-sign glyphicon-help" title="Taille comprise entre 1 et 20  caractères"></span>
                        </div>
                    </div>

                    <!-- nom -->
                    <div class="form-group">
                        <label for="nom" class="col-sm-4 control-label">Nom* :</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="nom" name="nom" placeholder="Votre nom..." value="<?=$_POST['nom'] ?? '' ?>">
                        </div>
                        <div class="col-sm-1">
                            <span class="glyphicon glyphicon-question-sign glyphicon-help" title="Taille comprise entre 1 et 20  caractères"></span>
                        </div>
                    </div>

                    <!-- email -->
                    <div class="form-group">
                        <label for="email" class="col-sm-4 control-label">Email* :</label>
                        <div class="col-sm-7">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Votre email..." value="<?=$_POST['email'] ?? '' ?>">
                        </div>
                        <div class="col-sm-1">
                            <span class="glyphicon glyphicon-question-sign glyphicon-help" title="Format email obligatoire"></span>
                        </div>
                    </div>

                    <!-- telephone -->
                    <div class="form-group">
                        <label for="telephone" class="col-sm-4 control-label">Téléphone :</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="telephone" name="telephone" placeholder="Votre n° de telephone..." value="<?=$_POST['telephone'] ?? '' ?>">
                        </div>
                        <div class="col-sm-1">
                            <span class="glyphicon glyphicon-question-sign glyphicon-help" title="Taille comprise entre 1 et 20 caractères"></span>
                        </div>
                    </div>

                    <!-- code postal -->
                    <div class="form-group">
                        <label for="cp" class="col-sm-4 control-label">Votre code postal :</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="cp" name="cp" placeholder="Votre code postal..." value="<?=$_POST['cp'] ?? '' ?>">
                            <small>Si renseigné, géolocalisera votre recherche</small>
                        </div>
                        <div class="col-sm-1">
                            <span class="glyphicon glyphicon-question-sign glyphicon-help" title="Taille de 5  caractères chiffrés"></span>
                        </div>
                    </div>

            </div> <!-- /.modal-body -->
            <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
            <button type="submit" id="inscription" name="inscription" class="btn btn-primary"><span style="margin-right:10px">S'inscrire </span><span style="color:#FFF" class="glyphicon glyphicon-edit" aria-hidden="true"></span></button>
            </form> <!-- FIN FORMULAIRE INSCRIPTION -->
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- MODAL CONNEXION -->
<div class="modal fade" id="ModalFormConnexion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h4 class="modal-title">Se connecter</h4>
            </div>
            <div class="modal-body">
                <!-- erreurs form-->
                <?=$contenu; ?>
                <!-- FORMULAIRE DE CONNEXION -->
                <form method="post" action="" class="form-horizontal">
                    <!-- pseudo -->
                    <div class="form-group">
                        <label for="pseudo_connexion" class="col-sm-4 control-label">Votre pseudo</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="pseudo_connexion" name="pseudo_connexion" placeholder="Votre pseudo..." autofocus />
                        </div>
                    </div>

                    <!-- mot de passe -->
                    <div class="form-group">
                        <label for="mdp_connexion" class="col-sm-4 control-label">Votre mot de passe</label>
                        <div class="col-sm-5">
                            <input type="password" class="form-control" id="mdp_connexion" name="mdp_connexion" placeholder="Votre mot de passe...">
                        </div>
                    </div>

                    <!-- remember me -->
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <div class="checkbox">
                                <label><input type="checkbox" name="remember" id="remember"> Se souvenir de moi</label>
                            </div>
                        </div>
                    </div>
            </div> <!-- /.modal-body -->

            <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
            <button type="submit" id="connexion" name="connexion" class="btn btn-primary"><span style="margin-right:10px">Se connecter </span><span style="color:#FFF" class="glyphicon glyphicon-log-in" aria-hidden="true"></span></button>
            </form> <!-- FIN FORMULAIRE CONNEXION -->
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->