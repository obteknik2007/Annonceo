//alert('');
$(function(){
    
 /*$('#map').vectorMap({
        map: 'fr_merc',
        backgroundColor:  'white', 
        onRegionClick:function(event, code){            
            var name = (code);  
            
              $.ajax({
                method : 'POST',
                url : 'php/front/home_filtre_dept.php',
                data : 'dept=' + code,
                success : function(data){
                  if(data == 'ko'){
                      //toast
                      setTimeout(function () {
                        toastr.options = {closeButton: true,progressBar: true,showMethod: 'fadeIn',timeOut: 1200};
                        toastr.warning('Pas d\'annonces actuellement dans le département ' + code);
                    }, 1300);
                  } else {
                    
                  document.location.href = "php/front/home.php?dept=" + code;
                }

                },
                error: function(XMLHttpRequest,textStatus,errorThrown){
                    alert(textStatus);
                }
            }); /* fin ajax */
/*            },
        regionStyle:{
              initial: {
                fill: 'grey',
                "fill-opacity": 1,
                stroke: 'none',
                "stroke-width": 0,
                "stroke-opacity": 1
              },
              hover: {
                fill: 'orange',
                "fill-opacity": 0.8,
                cursor: 'pointer'
              },
              selected: {
                fill: 'yellow'
              },
              selectedHover: {
              }
            }

});*/

//carte de france départements multi sélection
//https://numa-bord.com/miniblog/jquery-selection-departements-francais-carte/
//on masque le select classique
   // $("#map-selector").css("display", "none");
    //on ajoute un div #container-map-selector qui contiendra la carte
    //$("#map-selector").parent().append("<div id='container-map-selector'></div>");
    //on initie la carte sur cet élément

    var liste;
    var map = new jvm.Map({
        container: $("#container-map-selector"),
        map: 'fr_merc',
        regionsSelectable: true,
       //à chaque clic sur un département
        onRegionSelected: function () {
            //on vide le select
            $("#map-selector").val("");

            $("#list_dept_selected_code").html(map.getSelectedRegions());

            //et on sélectionne chaque option correspondant au département sélectionné sur la carte
            $.each(map.getSelectedRegions(), function (index, region) {
                $("#map-selector option[value=" + region + "]").prop("selected", true); 
            });
        }
    });

    //au départ si des options du select sont présélectionnés, on les sélectionnes sur la carte
    $("#map-selector option:selected").each(function () {
        map.setSelectedRegions($(this).val());

        //list_regions.push($(this).text());
    });
   


/****************************************************/
$('#retour_index_publier').on('click',function(e){
  e.preventDefault();
  document.location.href = "index.php";

}); 

/****************************************************************************/
/***  CONNEXION ***/
/****************************************************************************/
$('#connexion').on('click',function(e){
  e.preventDefault();

  // recup valeurs champs de connexion
  var pseudo_connexion  = $('#pseudo_connexion').val();
  var mdp_connexion   = $('#mdp_connexion').val();

  $.post('connexion.php','action=connexion&pseudo_connexion=' + pseudo_connexion + '&mdp_connexion=' + mdp_connexion,function(data){
      if(data == 'KO'){
        //toast erreur
        setTimeout(function () {
            toastr.options = {closeButton: true,progressBar: true,showMethod: 'fadeIn',timeOut: 2000};
            toastr.warning('Erreur sur les identifiants');
        }, 1300);
      } else {
        setTimeout(function () {
          toastr.options = {closeButton: true,progressBar: true,showMethod: 'fadeIn',timeOut: 2000};
          toastr.success('Vous êtes connecté.');

          document.location.href="index.php";
      }, 1300);

      
      }
  },'html');
}); //{} connexion

/***  DECONNEXION ***/
$('#deconnexion').on('click',function(e){
  e.preventDefault();

  $.post('connexion.php','action=deconnexion',function(data){
    if(data == 'ok'){

      setTimeout(function () {
        toastr.options = {closeButton: true,progressBar: true,showMethod: 'fadeIn',timeOut: 2000};
        toastr.success('Vous êtes maintenant déconnecté.');
    }, 1300);
      document.location.href="index.php";
      //window.location = window.location;
    } 
},'html');
}); //{} déconnexion

/****************************************************************************/
/***  INSCRIPTION ***/
/****************************************************************************/
$('#inscription').on('click',function(e){
  e.preventDefault();

 // recup valeurs champs de connexion
 var pseudo_inscription = $('#pseudo_inscription').val();
 var mdp_inscription    = $('#mdp_inscription').val();
 var civilite           = $('#civilite').val();
 var prenom             = $('#prenom').val();
 var nom                = $('#nom').val();
 var telephone          = $('#telephone').val();
 var email              = $('#email').val();

//envoi AJAX
 
 $.post('inscription_ajax.php','pseudo_inscription=' + pseudo_inscription + 
  '&mdp_inscription=' + mdp_inscription +
  '&civilite=' + civilite +
  '&prenom=' + prenom +
  '&nom=' + nom +
  '&telephone=' + telephone +
  '&email=' + email,
  function(json){
    //OK INSCRIPTION EFFECTUEE
     if(json == 'ok'){
      setTimeout(function () {
        toastr.options = {closeButton: true,progressBar: true,showMethod: 'fadeIn',timeOut: 2000};
        toastr.success('Merci de vous être inscrit sur notre site d\'annonces en ligne.');
    }, 1300);

      document.location.href="http://localhost/annonceo/index.php";

     } else {
       // ERREURS / TABLEAU JSON
       $('#inscription_erreurs').html(
        '<ul id="list_erreurs"></ul>');

      //CORPS liste : JE PARCOURE LES DATAS JSON ACTIONS
      $.each(json, function (index, value) {
          $('#list_erreurs').append('<li>' + value + '</li>');
      });
     }
 },'json');

}); //{} inscription
/****************************************************************************/
/*** form button cancel ****/
$('.cancel_form_update').on('click',function(e){
  e.preventDefault();
  $('#content_form_update').hide();
}); 

$('.cancel_form_add').on('click',function(e){
  e.preventDefault();
  $('#content_form_add').hide();
});   

/*** nettoyage de l'environnement ***/
$('#clean_environnement').on('click',function(){
  
  $.ajax({
    type : 'POST',
    cache: false,
    url : '../../php/back_office/clean_environnement.php',  
    success : function(data){ 
      if(data == 'ok'){
        setTimeout(function () {
          toastr.options = {closeButton: true,progressBar: true,showMethod: 'fadeIn',timeOut: 2000};
          toastr.success('Nettoyage terminé.');
      }, 1300);
      }
    },
    error: function(XMLHttpRequest,textStatus,errorThrown){
        alert(textStatus);
    }
  }); 
}); 



}); // FIN READY


/*$(function()
{
$('.slider').on('input change', function(){
          $(this).next($('.slider_label')).html(this.value);
        });
      $('.slider_label').each(function(){
          var value = $(this).prev().attr('value');
          $(this).html(value);
        });  
  
  
})*/