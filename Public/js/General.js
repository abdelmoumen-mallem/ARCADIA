class General {
  static logout() {
    if (!confirm("Êtes-vous sûr de vouloir vous déconnecter ?")) {
      return;
    }

    var url = "/deconnexion";
    var xhr = new XMLHttpRequest();

    xhr.open("GET", url, true);

    xhr.onload = function () {
      if (xhr.status >= 200 && xhr.status < 300) {
        window.location.href = "/connexion";
      } else {
        console.error("Erreur lors de la déconnexion :", xhr.statusText);
      }
    };

    xhr.send();
  }

  static insert(url, environnement) {
    console.log(environnement);
    document.getElementById("validation").style.display = "none";

    var id = document.getElementById("id").value;

    if (environnement === "compte_rendu") {
      var animal_id = document.getElementById("animal_id").value;
      var etat = document.getElementById("etat").value;
      var nouriture = document.getElementById("nouriture").value;
      var grammage = document.getElementById("grammage").value;
      var description = document.getElementById("description").value.trim();
      var utilisateur_id = document.getElementById("utilisateur_id").value;
    } else if (environnement === "animaux") {
      var prenom = document.getElementById("prenom").value;
      var race = document.getElementById("race").value;
      var habitat = document.getElementById("habitat").value;
      var statut = document.getElementById("statut").checked ? 1 : 0;
    } else if (environnement === "collaborateurs") {
      var username = document.getElementById("username").value;
      var nom = document.getElementById("nom").value;
      var prenom = document.getElementById("prenom").value;
      var statut = document.getElementById("statut").checked ? 1 : 0;
      var role_id = document.getElementById("role_id");
      var role_id_value;

      role_id = document.getElementById("role_id");

      if (role_id.classList.contains("d-none")) {
        role_id_value = 1;
      } else {
        role_id_value = role_id.value;
      }
    } else if (environnement === "consommations") {
      var utilisateur_id = document.getElementById("utilisateur_id").value;
      var animal_id = document.getElementById("animal_id").value;
      var nouriture = document.getElementById("nouriture").value;
      var grammage = document.getElementById("grammage").value;
    }

    var msg = document.getElementById("msg");

    var xhr = new XMLHttpRequest();
    var params =
      "&animal_id=" +
      encodeURIComponent(animal_id) +
      "&etat=" +
      encodeURIComponent(etat) +
      "&nouriture=" +
      encodeURIComponent(nouriture) +
      "&grammage=" +
      encodeURIComponent(grammage) +
      "&description=" +
      encodeURIComponent(description) +
      "&utilisateur_id=" +
      encodeURIComponent(utilisateur_id) +
      "&id=" +
      encodeURIComponent(id) +
      "&prenom=" +
      encodeURIComponent(prenom) +
      "&race=" +
      encodeURIComponent(race) +
      "&habitat=" +
      encodeURIComponent(habitat) +
      "&statut=" +
      encodeURIComponent(statut) +
      "&username=" +
      encodeURIComponent(username) +
      "&nom=" +
      encodeURIComponent(nom) +
      "&role_id=" +
      encodeURIComponent(role_id_value);
    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhr.onload = function () {
      if (xhr.status >= 200 && xhr.status < 300) {
        if (xhr.responseText == 2) {
          msg.classList.add("text-danger");
          msg.innerText = "Des informations sont manquantes";
          document.getElementById("validation").style.display = "block";
        } else if (xhr.responseText == 1) {
          msg.classList.add("text-danger");
          msg.innerText = "Des informations ont un mauvais format";
          document.getElementById("validation").style.display = "block";
        } else if (xhr.responseText == 3) {
          msg.classList.add("text-danger");
          msg.innerText = "Ce nom d'utilisateur est déjà utilisé";
          document.getElementById("validation").style.display = "block";
        } else if (xhr.responseText == 4) {
          msg.classList.add("text-danger");
          msg.innerText = "Le mail de création de password n'a pas été envoyé.";
          document.getElementById("validation").style.display = "block";
        } else if (xhr.responseText == 5) {
          msg.classList.add("text-danger");
          msg.innerText = "Le username n'est pas de type email.";
          document.getElementById("validation").style.display = "block";
        } else if (xhr.responseText == "false") {
          msg.classList.add("text-danger");
          msg.innerText = "Une erreur s'est produite";
          document.getElementById("validation").style.display = "block";
        } else if (xhr.responseText == "true") {
          msg.classList.remove("text-danger");
          msg.classList.add("text-success");
          if (url === "/collaborateurs_admin_insert") {
            msg.innerText =
              "Enregistrement effectué. Le mail de création de mot de passe a été envoyé au collaborateur.";
          } else {
            msg.innerText = "Enregistrement effectué.";
          }
        }
      } else {
        msg.classList.add("text-danger");
        msg.innerText = "Une erreur s'est produite";
      }
    };

    xhr.send(params);
  }

  static show(message) {
    document.getElementById("modalBody").innerHTML = message;
    document.getElementById("validation").classList.add("d-none");
  }

  static action(action, url, environnement) {
    var actionTitre = document.getElementById("staticBackdrop1Label1");
    actionTitre.innerText = action;

    var validationBtn = document.getElementById("validation");
    validationBtn.setAttribute("data-action", url);

    if (environnement === "collaborateurs") {
      if (action === "Creation") {
        document.getElementById("statut").checked = true;
        var role_id = document.getElementById("role_id");
        role_id.classList.remove("d-none");
      } else {
        null;
      }
    }
  }

  static fetch(id, url, environnement) {
    var action;
    if (environnement === "compte_rendu") {
      action = "/compte_rendu_admin_update";
    } else if (environnement === "animaux") {
      action = "/animaux_admin_update";
    } else if (environnement === "collaborateurs") {
      action = "/collaborateurs_admin_update";
    } else if (environnement === "consommations") {
      action = "/consommation_animaux_admin_update";
    }

    this.action("Modification", action);
    var xhr = new XMLHttpRequest();
    var params = "id=" + encodeURIComponent(id);
    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhr.onload = function () {
      if (xhr.status >= 200 && xhr.status < 300) {
        var serviceData = JSON.parse(xhr.responseText);

        document.getElementById("id").value = serviceData.id;

        if (environnement === "compte_rendu") {
          document.getElementById("animal_id").value = serviceData.animal_id;
          document.getElementById("etat").value = serviceData.etat;
          document.getElementById("nouriture").value = serviceData.nouriture;
          document.getElementById("grammage").value = serviceData.grammage;
          document.getElementById("description").value =
            serviceData.description;
          document.getElementById("utilisateur_id").value =
            serviceData.utilisateur_id;
        } else if (environnement === "animaux") {
          document.getElementById("prenom").value = serviceData.prenom;
          document.getElementById("habitat").value = serviceData.habitat_id;
          document.getElementById("race").value = serviceData.race_id;
          document.getElementById("statut").value = serviceData.statut;
          serviceData.statut == 1
            ? (document.getElementById("statut").checked = true)
            : (document.getElementById("statut").checked = false);
        } else if (environnement === "collaborateurs") {
          document.getElementById("username").value = serviceData.username;
          document.getElementById("nom").value = serviceData.nom;
          document.getElementById("prenom").value = serviceData.prenom;
          document.getElementById("statut").checked = serviceData.statut;
          document.getElementById("role_id").value = serviceData.role_id;
          document.getElementById("id").value = serviceData.id;

          if (serviceData.role_id != 1) {
            var role_id = document.getElementById("role_id");
            role_id.classList.remove("d-none");
          }
        } else if (environnement === "consommations") {
          document.getElementById("animal_id").value = serviceData.animal_id;
          document.getElementById("nouriture").value = serviceData.nouriture;
          document.getElementById("grammage").value = serviceData.grammage;
          document.getElementById("utilisateur_id").value =
            serviceData.utilisateur_id;
        }
      } else {
        console.error("Erreur lors de la requête :", xhr.statusText);
      }
    };

    xhr.send(params);
  }

  static delete(id, url, environnement) {
    var action;
    if (environnement === "compte_rendu") {
      action = "ce compte rendu";
    } else if (environnement === "animaux") {
      action = "cet animal";
    } else if (environnement === "collaborateurs") {
      action = "ce collaborateur";
    } else if (environnement === "consommations") {
      action = "cette consommation";
    }
    if (!confirm(`Êtes-vous sûr de vouloir supprimer ${action} ?`)) {
      return;
    }
    var xhr = new XMLHttpRequest();
    var params = "id=" + encodeURIComponent(id);
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
