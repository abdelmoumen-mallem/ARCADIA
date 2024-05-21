class Collaborateurs {
  static fetchCollaborateurInfo(collaborateurId, url) {
    this.actionCollaborateurs("Modification", "/collaborateurs_admin_update");
    var xhr = new XMLHttpRequest();
    var params = "id=" + encodeURIComponent(collaborateurId);
    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhr.onload = function () {
      if (xhr.status >= 200 && xhr.status < 300) {
        var collaborateurData = JSON.parse(xhr.responseText);
        document.getElementById("username").value = collaborateurData.username;
        document.getElementById("nom").value = collaborateurData.nom;
        document.getElementById("prenom").value = collaborateurData.prenom;
        document.getElementById("statut").checked = collaborateurData.statut;
        document.getElementById("role_id").value = collaborateurData.role_id;
        document.getElementById("id_collaborateur").value =
          collaborateurData.id;

        if (collaborateurData.role_id != 1) {
          var role_id = document.getElementById("role_id");
          role_id.classList.remove("d-none");
        }
      } else {
        console.error("Erreur lors de la requête :", xhr.statusText);
      }
    };

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

    xhr.onload = function () {
      if (xhr.status >= 200 && xhr.status < 300) {
        window.location.reload();
      } else {
        console.error("Erreur lors de la requête :", xhr.statusText);
      }
    };

    xhr.send(params);
  }

  static updateCollaborateur(url) {
    document.getElementById("validation").style.display = "none";
    var username = document.getElementById("username").value;
    var nom = document.getElementById("nom").value;
    var prenom = document.getElementById("prenom").value;
    var statut = document.getElementById("statut").checked ? 1 : 0;
    var id_collaborateur = document.getElementById("id_collaborateur").value;
    var msg = document.getElementById("msg");

    var role_id_value, role_id;

    role_id = document.getElementById("role_id");

    if (role_id.classList.contains("d-none")) {
      role_id_value = 1;
    } else {
      role_id_value = role_id.value;
    }

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
      encodeURIComponent(role_id_value) +
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
            msg.classList.remove("text-danger");
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

    xhr.send(params);
  }

  static actionCollaborateurs(action, url) {
    var actionTitre = document.getElementById("staticBackdrop1Label1");
    actionTitre.innerText = action;

    var validationBtn = document.getElementById("validation");
    validationBtn.setAttribute("data-action", url);

    if (action === "Creation") {
      document.getElementById("statut").checked = true;
      var role_id = document.getElementById("role_id");
      role_id.classList.remove("d-none");
    } else {
      null;
    }
  }

  static passwordCollaborateurs(id, username, nom, prenom, url) {
    if (
      !confirm(
        "Êtes-vous sûr de vouloir envoyer un email, servant a modifier le password de ce collaborateur ?"
      )
    ) {
      return;
    }
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

    xhr.send(params);
  }
}
