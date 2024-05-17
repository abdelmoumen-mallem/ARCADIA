class General {
  static fetchCollaborateurInfo(collaborateurId, url) {
    // Configurer les paramètres de la requête
    var xhr = new XMLHttpRequest();
    var url = url;
    var params = "id=" + collaborateurId;
    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    // Définir la fonction de rappel pour gérer la réponse
    xhr.onload = function () {
      if (xhr.status >= 200 && xhr.status < 300) {
        // La requête a réussi, obtenir les données JSON
        var collaborateurData = JSON.parse(xhr.responseText);
        // Remplir les champs de la modal avec les données récupérées
        document.getElementById("username").value = collaborateurData.username;
        document.getElementById("nom").value = collaborateurData.nom;
        document.getElementById("prenom").value = collaborateurData.prenom;
        document.getElementById("statut").checked = collaborateurData.statut;
        document.getElementById("role_id").value = collaborateurData.role_id;
      } else {
        // La requête a échoué, afficher un message d'erreur
        console.error("Erreur lors de la requête :", xhr.statusText);
      }
    };

    // Envoyer la requête avec les paramètres
    xhr.send(params);
  }
}
