<?php
session_start();
$message = "";

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Vérifie si le fichier a été uploadé sans erreur.
    if (isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0) {
        $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
        $filename = $_FILES["photo"]["name"];
        $filetype = $_FILES["photo"]["type"];
        $filesize = $_FILES["photo"]["size"];
        $filetmpname = $_FILES["photo"]["tmp_name"];
        $filemime = mime_content_type ( $filetmpname );

        // Recuperation de l'extension du fichier
        $ext = pathinfo($filename, PATHINFO_EXTENSION);

        // Vérifie l'extension du fichier
        if (array_key_exists($ext, $allowed)) {

            // Vérifie la taille du fichier - 1Mo maximum
            $maxsize = 1 * 1024 * 1024;
            if ($filesize < $maxsize) {

                // Vérifie le type MIME du fichier
                if (in_array($filemime, $allowed)) {

                    // on change le nom du fichier avant de le télécharger.
                    $_FILES["photo"]["name"] = md5(uniqid()) . '.' . $ext;
                    move_uploaded_file($_FILES["photo"]["tmp_name"], "upload/" . $_FILES["photo"]["name"]);
                    $message = "Votre image a été téléchargé avec succès.<br><br>
                    <a href=" . "upload/" . $_FILES["photo"]["name"] . " target=\"_blank\">
                        <button onclick=\"playsound()\" class=\"typo-specialelite btn-linkimg\"type=\"button\">lien vers l'image</button>
                    </a>";
                } else {
                    $message = "Erreur: Il y a eu un problème de téléchargement de votre fichier. Veuillez réessayer.";
                }
            }else {
                $message = "Erreur: La taille du fichier est supérieure à la limite autorisée.";
            }          
        }else {
            $message = "Erreur: Veuillez sélectionner un format de fichier valide.";
        };        
    } else {      
        $message = "Erreur: " . $_FILES["photo"]["error"] . " / fichier invalide";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="assets\style.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css2?family=Special+Elite&display=swap" rel="stylesheet">
    <link href="img\icon.png" rel="icon">
    <title>tp upload</title>
</head>

<body>

    <!------------------------------------------------- HEADER ------------------------------->
    <header>
        <div id="img-accueil" class="container-fluid">
            <div class="row justify-content-lg-start justify-content-center text-center">
                <div class="col-12 justify-content-center text-center">
                    <h1 class="typo-specialelite" id="titreHeader">Bovis-Shark</h1>
                </div>
            </div>
        </div>
    </header>
    <!------------------------------------------------- MAIN ------------------------------->
    <main id="id-main">
        <div class="container">
            <div class="row justify-content-center">
                <div class="row col-12 my-5 shadow justify-content-center rounded-lg" id="id-workarea">
                    <!------------------------------------------------- COL GAUCHE ------------------------------->
                    <div class="col-12 col-sm-10 col-md-6 border py-2 my-5 rounded-lg text-center">
                        <div>
                            <img class="preview" />
                        </div>
                        <form action="index.php" method="post" enctype="multipart/form-data">
                            <div class="form-group col-md-6">
                                <label for="account">Login :</label>
                                <input class="form-control" id="account" type="text" name="account"
                                    placeholder="nom de compte">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="password">Password :</label>
                                <input class="form-control" id="password" type="text" name="password"
                                    placeholder="mot de passe">
                            </div>
                            <div>
                                <input type="submit" value="connexion">
                            </div>
                        </form>
                        <a href="gallery.php">gallery</a>
                        <a href="dashboard.php">dashboard</a>
                    </div>
                    <!------------------------------------------------- COL DROITE ------------------------------->
                    <div class="col-12 col-sm-10 col-md-6 my-5 rounded-lg" onclick="playsound()">
                        <img class="rounded-lg" src="img\cover-crop-circle.jpg" alt="cover-crop-circle-Astronogeek"
                            width="100%">
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!------------------------------------------------- FOOTER ------------------------------->
    <footer>
        <div class="container-fluid">
            <div class="row justify-content-center text-center">
                <div class="col-12 foot py-3 typo-specialelite">
                    <span class="h5">@copiright Yves-Marie Drouard && Anthony Le Play</span>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    </script>
    <script src="assets/script.js"></script>
</body>

</html>