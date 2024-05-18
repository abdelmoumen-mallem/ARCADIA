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

    // Envoyer la requête
    xhr.send();
  }
}
