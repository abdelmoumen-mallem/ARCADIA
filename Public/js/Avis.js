class Avis {
  static insert(url) {
    var nom = document.getElementById("nom").value;
    var description = document.getElementById("description").value;
    var msg = document.getElementById("msg");

    var note = document
      .getElementById("validation")
      .getAttribute("data-action");

    var xhr = new XMLHttpRequest();
    var params =
      "nom=" +
      encodeURIComponent(nom) +
      "&description=" +
      encodeURIComponent(description) +
      "&note=" +
      encodeURIComponent(note);
    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhr.onload = function () {
      if (xhr.status >= 200 && xhr.status < 300) {
        if (xhr.responseText == 1) {
          msg.classList.add("text-danger");
          msg.innerText = "Des informations sont manquantes";
        } else if (xhr.responseText == 2) {
          msg.classList.add("text-danger");
          msg.innerText = "Veuillez saisir une notation";
        } else if (xhr.responseText == "true") {
          window.location.reload();
        }
      } else {
        msg.classList.add("text-danger");
        msg.innerText = "Une erreur s'est produite";
      }
    };

    xhr.send(params);
  }

  static show(message) {
    document.getElementById("description").innerHTML = message;
  }

  static update(id, visible, url, url2) {
    var visibleAlert = visible == 1 ? "visible" : "non visible";

    if (
      !confirm(`Êtes-vous sûr de vouloir rendre ${visibleAlert} cette avis ?`)
    ) {
      visible == 1
        ? (document.getElementById("visible_" + id).checked = false)
        : (document.getElementById("visible_" + id).checked = true);
      return;
    }

    var visibleValue = visible ? 1 : 0;

    var xhr = new XMLHttpRequest();
    var params =
      "id=" +
      encodeURIComponent(id) +
      "&visible=" +
      encodeURIComponent(visibleValue);

    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhr.onload = function () {
      if (xhr.status >= 200 && xhr.status < 300) {
        var rowAvis = document.getElementById("avis_" + id);
        if (visible == 1) {
          rowAvis.textContent = "Visible";
          rowAvis.classList.remove("text-bg-danger");
          rowAvis.classList.add("text-bg-success");
        } else {
          rowAvis.textContent = "Non-visible";
          rowAvis.classList.remove("text-bg-success");
          rowAvis.classList.add("text-bg-danger");
        }
      } else {
        console.error("Erreur lors de la requête :", xhr.statusText);
      }
    };

    xhr.send(params);
  }

  static notation(note) {
    var notations = document.querySelectorAll("i.bi-star");

    for (var i = 0; i < notations.length; i++) {
      if (i <= note) {
        notations[i].classList.add("bi-star-fill");
        notations[i].classList.add("text-warning");
      } else {
        notations[i].classList.remove("bi-star-fill");
        notations[i].classList.remove("text-warning");
      }
    }

    var validationBtn = document.getElementById("validation");
    validationBtn.setAttribute("data-action", note + 1);
  }
}
