let ville = distance = ""

window.onload = () => {
    // On initialise la carte et on la centre sur Paris
    let carte = L.map('map').setView([48.852969, 2.349903], 13);

    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 18,
    id: 'mapbox/streets-v11',
    tileSize: 512,
    zoomOffset: -1,
    accessToken: 'pk.eyJ1IjoiZ2F1c3MyNDNqIiwiYSI6ImNrcGluNzVmYTAwcTEycW9hdDNwYWRkNGEifQ.0ddlvcBZKIgA_imCNWdOqg'
}).addTo(carte);
               
}


// On récupère les champs de la page
let champVille = document.getElementById('champ-ville')
let champDistance = document.getElementById('champ-distance')
let valeurDistance = document.getElementById('valeur-distance')


// On écoute l'évènement "change" sur le champ ville
champVille.addEventListener("change", function(){
    // Ici nous chercherons les coordonnées GPS de la ville saisie
})

champDistance.addEventListener("change", function(){
    // On récupère la distance choisie
    distance = this.value

    // On écrit cette valeur sur la page
    valeurDistance.innerText = distance + " km"

    // Ici nous chercherons les agences correspondant à la localisation souhaitée
})



/**
 * Cette fonction effectue un appel Ajax vers une url et retourne une promesse
 * @param {string} url 
 */
 function ajaxGet(url){
    return new Promise(function(resolve, reject){
        // Nous allons gérer la promesse
        let xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function(){
            // Si le traitement est terminé
            if(xmlhttp.readyState == 4){
                // Si le traitement est un succès
                if(xmlhttp.status == 200){
                    // On résoud la promesse et on renvoie la réponse
                    resolve(xmlhttp.responseText);
                }else{
                    // On résoud la promesse et on envoie l'erreur
                    reject(xmlhttp);
                }
            }
        }

        // Si une erreur est survenue
        xmlhttp.onerror = function(error){
            // On résoud la promesse et on envoie l'erreur
            reject(error);
        }

        // On ouvre la requête
        xmlhttp.open('GET', url, true);

        // On envoie la requête
        xmlhttp.send(null);
    })
}


champVille.addEventListener("change", function(){
    // On envoie la requête ajax vers nominatim et on traite la réponse
    ajaxGet(`https://nominatim.openstreetmap.org/search?q=${this.value}&format=json&addressdetails=1&limit=1&polygon_svg=1`).then(reponse => {
        // On convertit la réponse en objet Javascript
        let data = JSON.parse(reponse)

        // On stocke la latitude et la longitude dans la variable ville
        ville = [data[0].lat, data[0].lon]

        // On centre la carte sur la ville
        carte.panTo(ville)
    })
})



champDistance.addEventListener("change", function(){
    // On récupère la distance choisie
    distance = this.value

    // On écrit cette valeur sur la page
    valeurDistance.innerText = distance + " km"

    // On vérifie si une ville a été saisie
    if(ville != ""){
        // On envoie les données au serveur
        ajaxGet(`http://AppGeo/chargeAgences.php?lat=${ville[0]}&lon=${ville[1]}&distance=${distance}`).then(reponse => {
            // On efface toutes les couches de la carte sauf les tuiles
            carte.eachLayer(function (layer) {
                if(layer.options.name != "tiles") carte.removeLayer(layer);
            });

            // On trace le cercle de rayon "distance"
            let circle = L.circle(ville, {
                color: '#4471C4',
                fillColor: '#4471C4',
                fillOpacity: 0.3,
                radius: distance * 1000,
            }).addTo(carte);

            // On convertit la réponse en objet Javascript
            let donnees = JSON.parse(reponse)
                    
            // On boucle sur les données (ES8)
            Object.entries(donnees).forEach(agence => {
                // Ici j'ai une seule agence
                // On crée un marqueur pour l'agence
                let marker = L.marker([agence[1].lat, agence[1].lon]).addTo(carte)
                marker.bindPopup(agence[1].nom)
            })

            // On centre et on zoome sur le cercle
            bounds = circle.getBounds();
            carte.fitBounds(bounds);
        })
    }
})