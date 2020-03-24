<?php

require_once 'Model/Database.php';
require_once 'Model/CochonBase.php';
require_once 'Model/PhotoBase.php';
require_once 'Model/LienCochonPhotoBase.php';
require_once 'Model/CouleurBase.php';
require_once 'Model/RaceBase.php';

class PhotoController {

    /** @param $_GET 
     * @return le rendu d'un affichage de photo avec ColorBox de jQuery
     * 
    */
    public static function displayPicturesPig($tabGET){
        // connection à la base
        $o_pdo =  new Database();
        $o_conn = $o_pdo->makeConnect();

        // recuperation des données
        $pictures = PhotoBase::getPictures($o_conn, 
            array(':coc_id' => $tabGET['id']));



        // envoi de la vue
        $loader = new \Twig_Loader_Filesystem('View/templates');
        $twig = new \Twig_Environment($loader, [
            'cache' => false,
        ]);
        echo $twig->render('galerie.html.twig', 
                ['cochon_id' => $tabGET['id'],
                'pictures' => $pictures]);
    }
}