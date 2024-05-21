class Services {
  static insertServices(url) {
    var nom = document.getElementById("nom").value;
    var description = document.getElementById("description").value;
    var formfile = document.getElementById("formFile").files[0];
    var id_service = document.getElementById("id_service").value;
    var image_url = document.getElementById("image_url").value;

    var msg = document.getElementById("msg");

    var formData = new FormData();

    formData.append("nom", nom);
    formData.append("description", description);
    formData.append("formFile", formfile);
    formData.append("id_service", id_service);
    formData.append("image_url", image_url);

    var xhr = new XMLHttpRequest();
    xhr.open("POST", url, true);

    xhr.onload = function () {
      if (xhr.status >= 200 && xhr.status < 300) {
        if (xhr.responseText == 1) {
          msg.classList.add("text-danger");
          msg.innerText = "Des informations sont manquantes";
        } else if (xhr.responseText == 2) {
          msg.classList.add("text-danger");
          msg.innerText = "Le fichier n'est pas téléchargée";
        } else if (xhr.responseText == 3) {
          msg.classList.add("text-danger");
          msg.innerText = "Ce service existe délà";
        } else if (xhr.responseText == 4) {
          msg.classList.add("text-danger");
          msg.innerText = "La taille du fichier depasse 5mo";
        } else if (xhr.responseText == 5) {
          msg.classList.add("text-danger");
          msg.innerText = "Le type de fichier n'est pas autorisé";
        } else if (xhr.responseText == 6) {
          msg.classList.add("text-danger");
          msg.innerText = "Le fichier n'est pas téléchargée";
        } else if (xhr.responseText == 7) {
          msg.classList.add("text-danger");
          msg.innerText = "Le fichier contient une erreur";
        } else if (xhr.responseText == "false") {
          msg.classList.add("text-danger");
          msg.innerText = "Une ereur est survenue";
        } else if (xhr.responseText == "true") {
          msg.classList.remove("text-danger");
          msg.classList.add("text-success");
          msg.innerText = "Enregistrement effectué.";
        } else if (xhr.responseText == 10) {
          msg.classList.add("text-danger");
          msg.innerText = "test";
        } else {
          msg.classList.add("text-danger");
          msg.innerText = "Une erreur s'est produite";
        }
      } else {
        msg.classList.add("text-danger");
        msg.innerText = "Une erreur s'est produite";
      }
    };

    xhr.send(formData);
  }

  static show(message) {
    document.getElementById("modalBody").innerHTML = message;
    document.getElementById("validation").classList.add("d-none");
  }

  static actionServices(action, url) {
    var actionTitre = document.getElementById("staticBackdrop1Label1");
    actionTitre.innerText = action;

    var labelFicher = document.getElementById("labelFicher");

    if (action == "Modification") {
      labelFicher.innerText = "Modifier le fichier";
    } else {
      labelFicher.innerText = "Sélectionnez un fichier";
    }

    var validationBtn = document.getElementById("validation");
    validationBtn.setAttribute("data-action", url);
  }

  static fetchServices(id, url) {
    this.actionServices("Modification", "/services_admin_update");
    var xhr = new XMLHttpRequest();
    var params = "id=" + encodeURIComponent(id);
    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhr.onload = function () {
      if (xhr.status >= 200 && xhr.status < 300) {
        var serviceData = JSON.parse(xhr.responseText);
        document.getElementById("nom").value = serviceData.nom;
        document.getElementById("description").value = serviceData.description;
        document.getElementById("id_service").value = serviceData.id;
        document.getElementById("image_url").value = serviceData.image_url;

        var openFile = document.getElementById("openFile");
        var timestamp = new Date().getTime();

        var filePath = "../img/" + serviceData.image_url + "?time=" + timestamp;
        openFile.setAttribute("href", filePath);
        openFile.classList.remove("d-none");
      } else {
        console.error("Erreur lors de la requête :", xhr.statusText);
      }
    };

    xhr.send(params);
  }

  static deleteServices(id, url) {
    if (!confirm("Êtes-vous sûr de vouloir supprimer ce service ?")) {
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
}
