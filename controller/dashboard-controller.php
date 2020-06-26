<?php

$accountArray = array('guest' => 'soleil123','admin' => 'lapinpgm');

$message = "";
$maxSize = 1 * 1024 * 1024;
$maxFolderSize = 40 * 1024 * 1024;
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
           
            if ($filesize < $maxSize) {

                // Vérifie le type MIME du fichier
                if (in_array($filemime, $allowed)) {

                    // on change le nom du fichier avant de le télécharger.
                    $filename = md5(uniqid()) . '.' . $ext;
                    move_uploaded_file($filetmpname, "upload/" . $filename);
                    $message = "Votre image a été téléchargé avec succès.<br><br>
                    <a href=" . "upload/" . $filename . " target=\"_blank\">
                        <button onclick=\"playsound()\" class=\"typo-specialelite btn-linkimg\"type=\"button\">lien vers l'image</button>
                    </a>";
                } else {
                    $message = "Erreur: Il y a eu un problème de téléchargement de votre fichier. Veuillez réessayer.";
                }
            }else {
                $message = "Erreur: La taille du fichier est supérieure à 1Mo ( il fait : " . $filesize / (1024 * 1024) . " Mo)";
            }          
        }else {
            $message = "Erreur: Veuillez sélectionner un format de fichier valide.";
        };        
    } else {      
        $message = "Erreur: " . $_FILES["photo"]["error"] . " / fichier invalide";
    }
}