// L'URL de base de l'API
const baseUrl = ' https://chuckapi.alwaysdata.net';
const resource = '/chuckapi/v2'

// Méthode pour effectuer un appel API GET pour récupérer toutes les phrases
function getAllPhrases() {

    fetch(`${baseUrl}${resource}/`)
    .then(response => response.json()) // Convertir la réponse en JSON
    .then(data => {
        displayInfoResponse(document.getElementById('infoGetAllPhrases'),data);
        displayData(data.data); //Afficher en console les données récupérées
    })
    .catch(error => console.error('Erreur Fetch:', error));

    // Affichage d'un message dans une boîte de dialogue pour l'exemple
    alert('J\'affiche les informations de la réponse HTTP dans la zone en dessous du bouton \n et toutes les phrases dans la zone en bas de page');
}

// Méthode pour effectuer un appel API GET pour récupérer une seule phrase
function getPhrase() {
    /*TODO : Remplacer/Adapter le code ci-dessous par votre code de récupération d'une phrase avec la méthode GET*/
    // Récupérer la valeur d'une balise <input> identifiée avec l'id 'phraseID' : <input type="text" id="phraseID">
    var valeurDeLaBalise = document.getElementById('phraseID').value;
    //Construire le message à afficher
    var message = 'Le contenu de la balise est : ' + valeurDeLaBalise;

    fetch(`${baseUrl}${resource}/${valeurDeLaBalise}`)
    .then(response => response.json()) // Convertir la réponse en JSON
    .then(data => {
        
        displayInfoResponse(document.getElementById('infoGetPhrase'),data);
        displayData(data.data); //Afficher en console les données récupérées
    })
    .catch(error => console.error('Erreur Fetch:', error));
    // Afficher un message dans une boîte de dialogue pour l'exemple
    alert(message);
}

function getSignal() {
    /*TODO : Remplacer/Adapter le code ci-dessous par votre code de récupération d'une phrase avec la méthode GET*/
    // Récupérer la valeur d'une balise <input> identifiée avec l'id 'phraseID' : <input type="text" id="phraseID">
    var valeur = document.getElementById('updatePhraseID').value;

    fetch(`${baseUrl}${resource}/${valeur}`)
    .then(response => response.json()) // Convertir la réponse en JSON
    .then(data => {
        
        displayInfoResponse(document.getElementById('infoGetPhrase'),data);
        return data.data[6];
    })
    .catch(error => console.error('Erreur Fetch:', error));

}

// Méthode pour créer une nouvelle phrase
function addPhrase() {
    /*TODO : Remplacer/Adapter le code ci-dessous par votre code d'envoi d'une phrase avec la méthode POST*/

    var valeur = document.getElementById('newPhrase').value;
    console.log(valeur);

    // Options de requête pour un envoi en méthode POST d’une donnée JSON
    const requestOptions = {
    method: 'POST', // Méthode HTTP
    headers: { 'Content-Type': 'application/json' }, // Type de contenu
    body: JSON.stringify({phrase:valeur}) // Corps de la requête
    };
    
    // Effectuer une requête POST pour envoyer des données JSON
    fetch(`${baseUrl}${resource}/`, requestOptions)
    .then(response => response.json()) // Convertir la réponse en JSON
    .then(data => {
        displayInfoResponse(document.getElementById('infoAddPhrase'),data); //Afficher en console les données récupérées
    })
    .catch(error => console.error('Erreur Fetch:', error));
    // Afficher un message dans une boîte de dialogue pour l'exemple
    alert('J\'envoie une phrase pour être créée dans la base de données');
}

// Méthode pour mettre à jour une phrase
function updatePhrase() {
    /*TODO : Remplacer/Adapter le code ci-dessous par votre code de mise à jour d'une phrase avec la méthode PATCH puis PUT*/

    var id = document.getElementById('updatePhraseID').value;
    var phrase = document.getElementById('updateContent').value;
    var vote= document.getElementById('updateVote').value;
    var signal=document.getElementById('updateSignalement').checked;
    var faute= document.getElementById('updateFaute').checked;
    var signals=signal+getSignal();

    // Options de requête pour un envoi en méthode POST d’une donnée JSON
    if(document.getElementById('methodPatch').checked){
        alert(1);
        const requestOptions = {
            method: 'PATCH', // Méthode HTTP
            headers: { 'Content-Type': 'application/json' }, // Type de contenu
            body: JSON.stringify({phrase:phrase,
                vote:vote,
                signalement:signals,
                faute:faute
            }
            )
        };
        fetch(`${baseUrl}${resource}/${id}`, requestOptions)
    .then(response => response.json()) // Convertir la réponse en JSON
    .then(data => {
        displayInfoResponse(document.getElementById('infoAddPhrase'),data); //Afficher en console les données récupérées
    })
    .catch(error => console.error('Erreur Fetch:', error));
    }else{
        alert(2);
        const requestOptions = {
            method: 'PUT', // Méthode HTTP
            headers: { 'Content-Type': 'application/json' }, // Type de contenu
            body: JSON.stringify({phrase:phrase,
                vote:vote,
                signalement:signals,
                faute: faute
            }
                )
            };
            fetch(`${baseUrl}${resource}/${id}`, requestOptions)
    .then(response => response.json()) // Convertir la réponse en JSON
    .then(data => {
        displayInfoResponse(document.getElementById('infoAddPhrase'),data); //Afficher en console les données récupérées
    })
    .catch(error => console.error('Erreur Fetch:', error));
    }
}

// Méthode pour supprimer une phrase
function deletePhrase() {
    /*TODO : Remplacer/Adapter le code ci-dessous par votre code de suppression d'une phrase avec la méthode DELETE*/

    var valeur = document.getElementById('deletePhraseID').value;
    
    fetch(`${baseUrl}${resource}/${valeur}`, {method:'DELETE'})
    .then(data => {
        displayInfoResponse(document.getElementById('infoDeletePhrase'),data); //Afficher en console les données récupérées
    })
    .catch(error => console.error('Erreur Fetch:', error));
    // Afficher un message dans une boîte de dialogue pour l'exemple
    alert('Je supprime une phrase avec DELETE');
}

// Méthode pour afficher les données dans le tableau HTML
function displayData(phrases) {
    const tableBody = document.getElementById('responseTableBody');
    tableBody.innerHTML = ''; // nettoie le tableau avant de le remplir
    const apiResponse = document.getElementById('apiResponse');
    apiResponse.style.display = phrases.length > 0 ? 'block' : 'none';

    phrases.forEach(phrase => {
        const row = tableBody.insertRow();
        row.insertCell(0).textContent = phrase.id;
        row.insertCell(1).textContent = phrase.phrase;
        row.insertCell(2).textContent = phrase.date_ajout;
        row.insertCell(3).textContent = phrase.date_modif;
        row.insertCell(4).textContent = phrase.vote;
        row.insertCell(5).textContent = phrase.faute;
        row.insertCell(6).textContent = phrase.signalement;
    });
}

// Mise à jour de la fonction pour afficher les informations de réponse
function displayInfoResponse(baliseInfo,info) {
    if(info) {
        baliseInfo.textContent = `Statut: ${info.status}, Code: ${info.status_code}, Message: ${info.status_message}`;
        baliseInfo.style.display = 'block';
    } else {
        baliseInfo.style.display = 'none';
    }
}

// Attacher les événements aux boutons
document.getElementById('getAllPhrases').addEventListener('click', getAllPhrases);
document.getElementById('getPhrase').addEventListener('click', getPhrase);
document.getElementById('addPhrase').addEventListener('click', addPhrase);
document.getElementById('deletePhrase').addEventListener('click', deletePhrase);
document.getElementById('updatePhrase').addEventListener('click', updatePhrase);
