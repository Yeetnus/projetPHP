const baseUrl = 'http://localhost/projet/projetPHP';
const resource = '/API_METHOD/functions_rdv.php';

function getAllRDV() {

    fetch(`${baseUrl}${resource}/`)
    .then(response => response.json()) // Convertir la réponse en JSON
    .then(data => {
        displayInfoResponse(document.getElementById('date'),data[1]);
        displayInfoResponse(document.getElementById('heure'),data[2]);
        displayInfoResponse(document.getElementById('duree'),data[3]);
        displayInfoResponse(document.getElementById('nomMed'),data[4]);
        displayInfoResponse(document.getElementById('nomUsa'),data[5]);
    })
    .catch(error => console.error('Erreur Fetch:', error));

    // Affichage d'un message dans une boîte de dialogue pour l'exemple
    alert('pute');
}

function displayInfoResponse(baliseInfo,info) {
    if(info) {
        baliseInfo.textContent = `Statut: ${info.status}, Code: ${info.status_code}, Message: ${info.status_message}`;
        baliseInfo.style.display = 'block';
    } else {
        baliseInfo.style.display = 'none';
    }
}
