const baseUrl = 'http://localhost/projet/projetPHP';
const resource = '/API_AUTH/login.php';

function veriflogin() {
    var login = document.getElementById('login').value;
    var mdp = document.getElementById('mdp').value;

    const requestOptions = {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ login: login, mdp: mdp })
    };

    fetch(`${baseUrl}${resource}`, requestOptions)
        .then(response => {
            console.log(response.status);
            switch (response.status) {
                case 200:
                    alert('Connexion réussie');
                    window.location.href = "http://localhost/projet/projetPHP/choix.php";
                    break;
                case 403:
                    alert("Login ou mot de passe incorrect");
                    break;
                default:
                    alert("Erreur inconnue");
            }
        })
        .catch(error => console.error('Erreur Fetch:', error));
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