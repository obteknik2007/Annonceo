/*$(document).ready(function(){
 alert('test FLOT !!!!');
 }); /* fin ready */
/*********************************************************************************************************/
//FUNCTIONS POUR GRAPHIQUES
/*********************************************************************************************************/
function gd(year, month, day) {
    return new Date(year, month, day).getTime();
}

var previousPoint = null,
    previousLabel = null;

$.fn.UseTooltip = function() {
    $(this).bind("plothover", function(event, pos, item) {
        if (item) {
            if ((previousLabel != item.series.label) || (previousPoint != item.dataIndex)) {
                previousPoint = item.dataIndex;
                previousLabel = item.series.label;
                $("#tooltip").remove();

                var x = item.datapoint[0];
                var y = item.datapoint[1];

                var color = item.series.color;

                //console.log(item.series.xaxis.ticks[x].label);

                showTooltip(item.pageX,
                    item.pageY,
                    color, "<strong>" + item.series.label + "</strong><br>" + item.series.xaxis.ticks[x].label + " : <strong>" + y + "</strong>");
            }
        } else {
            $("#tooltip").remove();
            previousPoint = null;
        }
    });
};

function showTooltip(x, y, color, contents) {
    $('<div id="tooltip">' + contents + '</div>').css({
        position: 'absolute',
        display: 'none',
        top: y - 40,
        left: x - 120,
        border: '2px solid ' + color,
        padding: '3px',
        'font-size': '9px',
        'border-radius': '5px',
        'background-color': '#fff',
        'font-family': 'Verdana, Arial, Helvetica, Tahoma, sans-serif',
        opacity: 0.9
    }).appendTo("body").fadeIn(200);
}
/*********************************************************************************************************/
// PREPA GRAPHE 1 : Nb d'annonces par mois
/*********************************************************************************************************/
function get_home_graph1(content_graph1){

    $.ajax({
        method : 'POST',
        url : 'php/back_office/stats_graph.php',
        cache: false,
        dataType: 'json',
        success : function(data){ /* début success */

            //si renvoi 'ko' alors pas de graph, sinon graphe
            if(data[0] == 'ko'){
                content_graph1.html(
                    '<p>Aucune donnée graphique disponible - Pas de client créé pour le moment.</p>'
                );

            } else {/* deb pas ko */

                var datasetGraph1 = [{
                    label: "Nb de clients créés", /* nom légende */
                    data: data,
                    color: "#5482FF" /* couleur barre histo */
                }];

                var ticks = [ /* axe abscisses */
                    [0, "Janvier"],
                    [1, "Février"],
                    [2, "Mars"],
                    [3, "Avril"],
                    [4, "Mai"],
                    [5, "Juin"],
                    [6, "Juillet"],
                    [7, "Août"],
                    [8, "Septembre"],
                    [9, "Octobre"],
                    [10, "Novembre"],
                    [11, "Décembre"]
                ];

                var optionsGraph1 = {
                    series: {
                        bars: {
                            show: true
                        }
                    },
                    bars: {
                        align: "center",
                        barWidth: 0.5
                    },
                    xaxis: {
                        axisLabel: "Mois",
                        axisLabelUseCanvas: true,
                        axisLabelFontSizePixels: 12,
                        axisLabelFontFamily: 'Verdana, Arial',
                        axisLabelPadding: 10,
                        ticks: ticks

                    },
                    yaxis: {
                        axisLabel: "Nb",
                        axisLabelUseCanvas: true,
                        axisLabelFontSizePixels: 12,
                        axisLabelFontFamily: 'Verdana, Arial',
                        axisLabelPadding: 3
                        //tickFormatter: function(v, axis) { /* format étiquettes axe Y */
                        //    return v + "°C";
                        //}
                    },
                    /*legend: {
                        noColumns: 0,
                        labelBoxBorderColor: "#000000",
                        position: "nw"
                    },*/
                    grid: {
                        hoverable: true,
                        borderWidth: 0,
                        backgroundColor: {
                            colors: ["#FFFFAA", "#EDF5FF"]
                        }
                    }
                };

                content_graph1.css({
                    'width':'300px',
                    'height':'200px',
                    'margin':'0 auto',
                    'padding':'10px'
                });

                $.plot(content_graph1, datasetGraph1, optionsGraph1);
                content_graph1.UseTooltip();
            } /* fin pas ko */

        }, /* fin success */
        error: function(XMLHttpRequest,textStatus,errorThrown){
            alert(textStatus);
        } /* fin error */
    }); /* fin ajax */
}