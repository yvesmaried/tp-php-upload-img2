<?php
session_start();
require_once 'my-config.php';
require_once 'controller\dashboard-controller.php';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="assets\style.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css2?family=Special+Elite&display=swap" rel="stylesheet">
    <link href="img\icon.png" rel="icon">
    <link href="path/to/lightbox.css" rel="stylesheet" />
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

                        <p class="text-left"><b class="typo-specialelite">Formats autorisés : </b>.jpg, .jpeg, .gif, .png<br>
                            <b class="typo-specialelite">Taille max unitaire : </b><?= round(($maxSize / (1024 * 1024)), 2) ?> Mo.<br>
                            <b class="typo-specialelite">Taille dossier : </b><?= round((TailleDossier("upload") / (1024 * 1024)), 2) ?>Mo / <?= round(($maxFolderSize / (1024 * 1024)), 2) ?>Mo.</p>
                        <h2 class="typo-specialelite">Envoyer votre image</h2>
                        <form action="" method="post" enctype="multipart/form-data">
                            <label for="fileUpload">Fichier:</label>
                            <input type="file" data-preview=".preview" name="photo" id="fileUpload"><br>
                            <div class="text-center">
                                <img class="preview">
                            </div><br>
                            <button id="uploadImput" class="typo-specialelite" name="submit" type="submit"><img href="img\icon.png">
                                <svg class="bi bi-cloud-upload" width="1.5em" height="1.5em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4.887 6.2l-.964-.165A2.5 2.5 0 1 0 3.5 11H6v1H3.5a3.5 3.5 0 1 1 .59-6.95 5.002 5.002 0 1 1 9.804 1.98A2.501 2.501 0 0 1 13.5 12H10v-1h3.5a1.5 1.5 0 0 0 .237-2.981L12.7 7.854l.216-1.028a4 4 0 1 0-7.843-1.587l-.185.96z" />
                                    <path fill-rule="evenodd" d="M5 8.854a.5.5 0 0 0 .707 0L8 6.56l2.293 2.293A.5.5 0 1 0 11 8.146L8.354 5.5a.5.5 0 0 0-.708 0L5 8.146a.5.5 0 0 0 0 .708z" />
                                    <path fill-rule="evenodd" d="M8 6a.5.5 0 0 1 .5.5v8a.5.5 0 0 1-1 0v-8A.5.5 0 0 1 8 6z" />
                                </svg>
                                Upload
                                <svg class="bi bi-cloud-upload" width="1.5em" height="1.5em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4.887 6.2l-.964-.165A2.5 2.5 0 1 0 3.5 11H6v1H3.5a3.5 3.5 0 1 1 .59-6.95 5.002 5.002 0 1 1 9.804 1.98A2.501 2.501 0 0 1 13.5 12H10v-1h3.5a1.5 1.5 0 0 0 .237-2.981L12.7 7.854l.216-1.028a4 4 0 1 0-7.843-1.587l-.185.96z" />
                                    <path fill-rule="evenodd" d="M5 8.854a.5.5 0 0 0 .707 0L8 6.56l2.293 2.293A.5.5 0 1 0 11 8.146L8.354 5.5a.5.5 0 0 0-.708 0L5 8.146a.5.5 0 0 0 0 .708z" />
                                    <path fill-rule="evenodd" d="M8 6a.5.5 0 0 1 .5.5v8a.5.5 0 0 1-1 0v-8A.5.5 0 0 1 8 6z" />
                                </svg>
                            </button><br><br>
                        </form>

                        <p id="messageresult" class="typo-specialelite h5"><b><?= $message ?></b></p>
                        <a href="index.php"><button class="btn-perso typo-specialelite" type="button">Acceuil</button></a>
                        <a href="gallery.php"><button class="btn-perso typo-specialelite" type="button">Galerie</button></a>
                        <a href="deconnexion.php"><button class="btn-perso typo-specialelite" type="button">deconnexion</button></a>
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

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    </script>
    <script src="assets/script.js"></script>
    <script src="path/to/lightbox.js"></script>
</body>

</html>