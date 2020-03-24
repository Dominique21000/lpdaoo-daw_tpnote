<?php

class Photo
{
    /** effectue le traitement pour enregister la photo sur le disque 
     * @param $tFile => tableau $_FILES
     * @param $nom => nom du champ de formulaire qui a eu le fichier
     * @param $id => id de la photo pour nommer le fichier 
    */
    public static function savePhoto($tFile, $nom, $id){
        $dest_dossier = $_SERVER['DOCUMENT_ROOT'] . "/TP-Note/public/img/photo/"; // dest de l'upload
        $dest_fichier = $dest_dossier . $id;
        $tailleMaxi = 3145728; // taille maxi pour un fichier, en octets.

        if (isset($tFile[$nom]))
        {
            if ((is_uploaded_file($tFile[$nom]['tmp_name'])))
            {
                // le fichier a bien été uploadé
                $uploadOk = 1;

                // verification du fichier
                //echo "Fichier uploadé avec succès.<br>";
                // on test le type
                if (strstr($tFile[$nom]['type'],"image") == false){
                    $uploadOk = 0;
                    echo "Vous avez tenté d'uploadé autre chose qu'une image.<br>";
                }
                // on test la taille :
                if ($tFile[$nom]['size'] > $tailleMaxi){
                    $uploadOk = 0;
                    echo "L'image que vous avez tenté d'uploadé est trop grande.<br>";
                }

                // pour l'ajout de l'extension
                if ($tFile[$nom]['type'] == "image/jpeg")        {
                    $extension = ".jpeg";
                }
                if ($tFile[$nom]['type'] == "image/png"){
                    $extension = ".png";
                }

                // on déplace le fichier
                $destination_complet = $dest_fichier.$extension;

                if (is_file($destination_complet)) {
                    // => le fichier existe déjà => on supprime
                    if (unlink($destination_complet) == true)
                    {
                        // le fichier a bien été supprimé => on continue
                        $fichierOk = 1;
                    }
                    else{
                        //  echo "Ce n'est pas uploadé une image avec la taille adéquate.";
                        echo "L'image déjà présente n'a pas pu être supprimée.<br>";
                    }
                }
                else{
                    // Le fichier n'existe pas... on peut y aller
                    $fichierOk = 1;
                }

                // déplacement
                if ($fichierOk == 1){
                    if (is_uploaded_file($tFile[$nom]['tmp_name']))
                    {
                        //print("fichier téléchargé avec succès");
                    }
                    if (move_uploaded_file($tFile[$nom]['tmp_name'], $destination_complet)) {
                        echo "Le fichier " . $nom . " été correctement déplacé pour " .$destination_complet ."<br>";
                        $fichier_svg = 1;
                    }
                    else
                    {
                        echo "Problème avec le déplacement.<br>";
                    }
                }
            }
        }
    }
}