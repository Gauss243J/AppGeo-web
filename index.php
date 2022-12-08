<?php

?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>OpenStreetMap</title>
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin=""/>
        <!-- CSS -->
        <style>
            body{

                margin:0
            }
            #maCarte{
                height: 100vh;
            }


            .container {
                width: 100%;
                height: 100%;
                border: 2px solid #000;
                padding: 2px;
                margin: 4px 0px 0px 0px;
            }
            .containerinfo{

                width:100%;
         
    
            }
            .container-photo{
                border: 1px solid #000;
                width:97%;
                margin: 0px auto 0px auto;
            }
            .container-info{
                border: 1px solid #000;
                width:95%;
                padding: 0px 0px 0px 4px;
                margin: 2px 0px 0px 0px;}
            .containerButton{
                padding: 5px;}

            .title {
                font-weight: bold;
            }
            input{
                padding: 5px;
                background-color:  #000;
                color:white;
                font-weight: bold;
                border-radius:5px;
            }

           img{
                weight: 59px;
                width: 59px;
            }
        </style>
    </head>
    <body>
        <div id="maCarte"></div>

        <!-- Fichiers Javascript -->
        <script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js" integrity="sha512-GffPMF3RvMeYyc1LWMHtK8EbPv0iNZ8/oTtHPx9/cc2ILxQ+u905qIwdpULaqDkyBKgOaB57QTMg7ztg8Jm2Og==" crossorigin=""></script>
        <script>
            // On initialise la carte
            var carte = L.map('maCarte').setView([-1.6591232, 29.1820287], 13);
            
            // On charge les "tuiles"
            L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
                // Il est toujours bien de laisser le lien vers la source des données
                attribution: 'données © <a href="//osm.org/copyright">OpenStreetMap</a>/ODbL - rendu <a href="//openstreetmap.fr">OSM France</a>',
                minZoom: 1,
                maxZoom: 20,
                accessToken: 'pk.eyJ1IjoiZ2F1c3MyNDNqIiwiYSI6ImNrcGluNzVmYTAwcTEycW9hdDNwYWRkNGEifQ.0ddlvcBZKIgA_imCNWdOqg'
            }).addTo(carte);
           // var marker = L.marker([48.852969, 2.349903]).addTo(carte);

           let a; 

           setInterval(function(){
		

            let xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = () => {
                // La transaction est terminée ?
                if(xmlhttp.readyState == 4){
                    // Si la transaction est un succès
                    if(xmlhttp.status == 200){
                        // On traite les données reçues
                        let donnees = JSON.parse(xmlhttp.responseText)
                        
                        // On boucle sur les données (ES8)
                        Object.entries(donnees.agences).forEach(agence => {
                            // Ici j'ai une seule agence
                            // On crée un marqueur pour l'agence
                            console.log(agence[1]);
                            var texte= '<div class="container"> <div class="containerinfo"> <div class="container-photo" id="photo">   <img src="'+agence[1].photo+'"/> </div><div class="container-info">'+
            '<p><label class="title" for="name">Nom:</label> <label class="respo" for="name">'+agence[1].nom+'</label><br /><label class="title" for="name">Phone:</label>'
                +'<label class="trspo" for="name">'+agence[1].numeroPhone+'</label></p></div></div>'
+'<div  class="containerAdresse"><fieldset> <legend>Adresse</legend><p><label class="title" for="name">Commune:</label><label class="respo" for="name">'+agence[1].commune+'</label><br />'
        +'<label class="title" for="name">Quartier:</label><label class="respo" for="name">'+agence[1].quartier+'</label><br /><label class="title" for="name">Avenue:</label><label class="respo" for="name">'+agence[1].avenue+'</label><br /><label class="title" for="name">Numero:</label><label class="respo" for="name">'+agence[1].numero+'</label>'
        +'</p></fieldset></div><div class="containerButton"><input id="btn" type="button"  value="Accuser reception"></input></div></div>';

                            a=agence[1].idAlerte;
                            var text = '<h3>' + 'Salut' + '</h3><h4>'+ '</h4><img src="http://localhost/AppGeo/connection/imagearuser/1636127857137.jpg" width="200px" /><br>Visitors: '+agence[1].nom;
                            let marker = L.marker([agence[1].latitude, agence[1].longitude]).addTo(carte);
                           // alerte(agence[1].latitude);
                            marker.bindPopup(texte);
                        })
                
         
                         
                      
                        const clickbtn=  document.getElementById("btn");
             clickbtn.addEventListener("click",()=>{
                clickbtn.style.display="none";
        
                let xmlhttps = new XMLHttpRequest();
                //alert("Salut1");
        xmlhttps.onreadystatechange = () => {
   
            if(xmlhttps.readyState == 4){
                // Si la transaction est un succès
                
                alert("C'est fait");
            }
        }
       

        xmlhttps.open("GET", "http://localhost/AppGeo/UpdateAccuser.php?idAlerte="+a);
        xmlhttps.send(null);

             });   
                    }else{
                        console.log(xmlhttp.statusText);
                    }
                }
            }

            xmlhttp.open("GET", "http://localhost/AppGeo/liste_simple.php");

            xmlhttp.send(null);
            }, 1000);

  

        </script>
    </body>
</html>
 <!--<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>

        Fichiers CSS 
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin=""/>
        <link rel="stylesheet" href="css/styles.css">
        <style>
#map { height: 500px; 
    width: 500px;
}
</style>
    </head>
    <body>-->
        <!--Carte-->
       <!-- <div id="map"></div>
<!--
        <!--Champs de recherche-->-->
       <!-- <p>
            <label for="champ-ville">Ville : </label>
            <input type="text" id="champ-ville">
        </p>
        <p>
            <label for="champ-distance">Distance : </label>
            <input type="range" min="1" max="200" id="champ-distance">
        </p>
        <p id="valeur-distance"></p>-->
     <!--   
       <!-- Fichiers JS -->
    <!--    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>
        <div id="map">
 <script src="js/scripts.js">
 
    </script>
    </div>
    </body>
</html>