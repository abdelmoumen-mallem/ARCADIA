<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création de mot de passe</title>
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        Création de mot de passe
                    </div>
                    <div class="card-body">
                        <p>Bonjour {{prenom}} {{nom}},</p>
                        <p>{{action}}</p><br>
                        <p>Veuillez cliquer sur le lien ci-dessous pour définir votre mot de passe:</p>

                        <div style="margin-top: 50px;">
                            <div style="background-color: #007bff; padding: 10px; border-radius: 5px; display: inline-block;">
                                <a href="http://localhost/creationPassword/{{id}}" style="text-decoration: none; color: #fff; padding: 10px 20px; border-radius: 5px; background-color: #007bff;">Définir le mot de passe</a>
                            </div>
                        </div><br>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>