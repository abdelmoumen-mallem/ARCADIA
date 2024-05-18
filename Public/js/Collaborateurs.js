class Collaborateurs {
  static fetchCollaborateurInfo(collaborateurId, url) {
    this.actionCollaborateurs("Modification", "/collaborateurs_admin_update");
    // Configurer les paramètres de la requête
    var xhr = new XMLHttpRequest();
    var params = "id=" + encodeURIComponent(collaborateurId);
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
        document.getElementById("id_collaborateur").value =
          collaborateurData.id;
      } else {
        // La requête a échoué, afficher un message d'erreur
        console.error("Erreur lors de la requête :", xhr.statusText);
      }
    };

    // Envoyer la requête avec les paramètres
    xhr.send(params);
  }

  static deleteCollaborateurs(collaborateurId, url) {
    if (!confirm("Êtes-vous sûr de vouloir supprimer ce collaborateur ?")) {
      return;
    }
    var xhr = new XMLHttpRequest();
    var params = "id=" + encodeURIComponent(collaborateurId);
    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    // Définir la fonction de rappel pour gérer la réponse
    xhr.onload = function () {
      if (xhr.status >= 200 && xhr.status < 300) {
        window.location.reload();
      } else {
        // La requête a échoué, afficher un message d'erreur
        console.error("Erreur lors de la requête :", xhr.statusText);
      }
    };

    // Envoyer la requête avec les paramètres
    xhr.send(params);
  }

  static updateCollaborateur(url) {
    // Récupérer les valeurs des champs du formulaire
    var username = document.getElementById("username").value;
    var nom = document.getElementById("nom").value;
    var prenom = document.getElementById("prenom").value;
    var role_id = document.getElementById("role_id").value;
    var statut = document.getElementById("statut").checked ? 1 : 0;
    var id_collaborateur = document.getElementById("id_collaborateur").value;
    var msg = document.getElementById("msg");

    // Créer une instance de XMLHttpRequest
    var xhr = new XMLHttpRequest();
    var params =
      "id=" +
      encodeURIComponent(id_collaborateur) +
      "&username=" +
      encodeURIComponent(username) +
      "&nom=" +
      encodeURIComponent(nom) +
      "&prenom=" +
      encodeURIComponent(prenom) +
      "&role_id=" +
      encodeURIComponent(role_id) +
      "&statut=" +
      encodeURIComponent(statut);
    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhr.onload = function () {
      if (xhr.status >= 200 && xhr.status < 300) {
        if (xhr.responseText == 2) {
          msg.classList.add("text-danger");
          msg.innerText = "Des informations sont manquantes";
        } else if (xhr.responseText == 3) {
          msg.classList.add("text-danger");
          msg.innerText = "Ce nom d'utilisateur est déjà utilisé";
        } else if (xhr.responseText == 4) {
          msg.classList.add("text-danger");
          msg.innerText = "Le mail de création de password n'a pas été envoyé.";
        } else if (xhr.responseText == "false") {
          msg.classList.add("text-danger");
          msg.innerText = "Une erreur s'est produite";
        } else if (xhr.responseText == "true") {
          if (url === "/collaborateurs_admin_update") {
            msg.classList.add("text-success");
            msg.innerText = "Enregistrement effectué.";
          } else {
            document.getElementById("validation").style.display = "none";
            msg.classList.add("text-success");
            msg.innerText =
              "Enregistrement effectué. Le mail de création de mot de passe a été envoyé au collaborateur.";
          }
        }
      } else {
        msg.classList.add("text-danger");
        msg.innerText = "Une erreur s'est produite";
      }
    };

    // Envoyer la requête avec les données JSON
    xhr.send(params);
  }

  static actionCollaborateurs(action, url) {
    var actionTitre = document.getElementById("staticBackdrop1Label1");
    actionTitre.innerText = action;

    var validationBtn = document.getElementById("validation");
    validationBtn.setAttribute("data-action", url);

    action === "Creation"
      ? (document.getElementById("statut").checked = true)
      : null;

    console.log(url);
  }

  static passwordCollaborateurs(id, username, nom, prenom, url) {
    if (
      !confirm(
        "Êtes-vous sûr de vouloir envoyer un email, servant a modifier le password de ce collaborateur ?"
      )
    ) {
      return;
    }
    // Configurer les paramètres de la requête
    var xhr = new XMLHttpRequest();
    var params =
      "id=" +
      encodeURIComponent(id) +
      "&username=" +
      encodeURIComponent(username) +
      "&nom=" +
      encodeURIComponent(nom) +
      "&prenom=" +
      encodeURIComponent(prenom);

    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    // Envoyer la requête avec les paramètres
    xhr.send(params);
  }
}
