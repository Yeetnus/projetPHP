const baseUrl = 'http://localhost/projet/projetPHP/';
const resource = '/API_AUTH/login.php'

function veriflogin() {
      var login = document.getElementById('login').value;
      var mdp = document.getElementById('mdp').value;
      console.log(username, password);

      const requestOptions = {
        method: 'POST', // Méthode HTTP
        headers: { 'Content-Type': 'application/json' }, // Type de contenu
        body: JSON.stringify({login:login,
        mdp:mdp}) // Corps de la requête
      };
      
      // Effectuer une requête POST pour envoyer des données JSON
      fetch(`${baseUrl}${resource}/`, requestOptions)
      .then(response => response.json()) // Convertir la réponse en JSON
      .catch(error => console.error('Erreur Fetch:', error));
      // Afficher un message dans une boîte de dialogue pour l'exemple
      console.log('ea');
      switch(response.status) {
        case 200:
          window.location.href = "http://localhost/projet/projetPHP/choix.php";
          break;
        case 401:
          alert("Login ou mot de passe incorrect");
          break;
        default:
          alert("Erreur inconnue");
      }
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