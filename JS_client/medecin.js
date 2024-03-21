$(document).ready(function () {
    getAllMedecin();
});

const baseUrl = 'http://localhost/projet/projetPHP';
const resource = '/API_METHOD/medecins.php';

function getAllMedecin() {

    fetch(`${baseUrl}${resource}`)
    .then(response => response.json()) // Convertir la réponse en JSON
    .then(data => {
        displayData(data.data);
    })
    .catch(error => console.error('Erreur Fetch:', error));

    // Affichage d'un message dans une boîte de dialogue pour l'exemple
}

function displayData(medecins) {
    console.log(medecins.nom);
    const tableBody = document.getElementById('myTable');
    tableBody.deleteRow(1);
    medecins.forEach(medecin => {
        const row = tableBody.insertRow();
        row.insertCell(0).textContent = medecin.nom;
        row.insertCell(1).textContent = medecin.prenom;
        row.insertCell(2).textContent = medecin.civilite;
        const imgCell = row.insertCell(3);
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

function recherche() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");

    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0];
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
};