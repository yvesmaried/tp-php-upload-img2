<?php

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
           
            if ($filesize <= $maxSize && TailleDossier("upload")+$filesize <= $maxFolderSize) {

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
            }else if($filesize > $maxSize){
                $message = "Erreur: La taille du fichier est supérieure à 1Mo ( il fait : " . $filesize / (1024 * 1024) . " Mo)";
            }else{
                $message = "Erreur: La taille du fichier correct, mais le dossier depassera la limite";
            }     
        }else {
            $message = "Erreur: Veuillez sélectionner un format de fichier valide.";
        };        
    } else {      
        $message = "Erreur: " . $_FILES["photo"]["error"] . " / fichier invalide";
    }
}
function TailleDossier($Rep)
{
    $Racine=opendir($Rep);
    $Taille=0;
    while($Dossier = readdir($Racine))
    {
      if ( $Dossier != '..' And $Dossier !='.' )
      {
        //Ajoute la taille du sous dossier
        if(is_dir($Rep.'/'.$Dossier)) $Taille += TailleDossier($Rep.'/'.
$Dossier);
        //Ajoute la taille du fichier
        else $Taille += filesize($Rep.'/'.$Dossier);

      }
    }
    closedir($Racine);
    return $Taille;
}