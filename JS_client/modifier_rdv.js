$(document).ready(function() {
    getAllRDV();
    alert("oui");
});

const baseUrl = 'http://localhost/projet/projetPHP';
const resource = '/API_METHOD/consultations';

function getAllRDV() {

    fetch(`${baseUrl}${resource}`)
    .then(response => response.json()) // Convertir la réponse en JSON
    .then(data => {
        displayData(data.data);
    })
    .catch(error => console.error('Erreur Fetch:', error));

    // Affichage d'un message dans une boîte de dialogue pour l'exemple
}

function displayData(phrases) {
    const tableBody = document.getElementById('myTable');
    tableBody.deleteRow(1);
    phrases.forEach(phrase => {
        const row = tableBody.insertRow();
        const date=new Date(phrase.date_consult);
        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0'); // Adding 1 because months are zero-based
        const day = String(date.getDate()).padStart(2, '0');

        const newDateFormat = `${day}/${month}/${year}`;
        row.insertCell(0).textContent = newDateFormat;
        row.insertCell(1).textContent = phrase.heure_consult;
        row.insertCell(2).textContent = phrase.duree_consult;
        row.insertCell(3).textContent = phrase.nomMed;
        row.insertCell(4).textContent = phrase.nomUsager;

        const imgCell = row.insertCell(5);
        const img = document.createElement('img');
        img.src = '../../IMAGES/update-icon-50.png'; // Set the image source
        img.alt = 'Modifier la consultation'; // Set the alternative text for accessibility

        // Create a link element
        const link = document.createElement('a');
        // Set the href attribute of the link element
        link.href = 'modification.php'; // Replace '#' with the URL you want to navigate to or a JavaScript function
        // Append the image to the link element
        link.appendChild(img);
        // Append the link element to the cell
        imgCell.appendChild(link);
    });
}


