// Méthode pour créer une nouvelle phrase
function addPhrase() {
    /*TODO : Remplacer/Adapter le code ci-dessous par votre code d'envoi d'une phrase avec la méthode POST*/

    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;
    console.log(username, password);


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