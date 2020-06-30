<?php
if(!(isset($_SESSION['admin']) || isset($_SESSION['guest']))){
    header("location:no-allowed.php"); // redirection
    exit; // arrêt du script
};
$fileArray = scandir('upload');
array_shift($fileArray);
array_shift($fileArray);
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