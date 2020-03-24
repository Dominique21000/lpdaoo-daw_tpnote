<?php
session_start();

function registre(){
    include_once ('Controller/SiteController.php');
    require_once 'vendor/autoload.php';

}
include_once('Controller/SiteController.php');
include_once('Controller/CochonController.php');

spl_autoload('registre');

if (isset($_GET["rub"])){
    $rubrique = strtolower($_GET["rub"]);
    switch($rubrique)
    {
        case "societe":
            SiteController::displayFirm($_GET);
            break;
    
        case "contact":
            SiteController::displayContact($_GET); 
            break;

        case "onglet-1":
            SiteController::displayOnglet1();
            break;

        case "onglet-2":
            SiteController::displayOnglet2();
            break;
            
        case "charger-cochons":
            CochonController::displayActivPigs($_POST, $_GET);
            break;

        case "details":
            CochonController::displayDetailsPig($_GET);
            break;

    
        // la partie admin
        case "admin":
            SiteController::afficherPageConnexion($_GET);
            break;

        case "admin_verif":
            //echo "dans admin_verif";
            SiteController::authentification($_POST); 
            break;

        case "admin_pig-list":
            // display the list of the pig
            CochonController::displayListOfPig($_GET);
            break;

        case "admin_pig-add":
            CochonController::addUpdatePigForm($_GET);
            break;

        case "admin_pig-update":
            CochonController::addUpdatePigForm($_GET);
            break;

        case "admin_pig-add-base":
            CochonController::addPigBase($_POST, $_FILES);
            break;

        case "admin_pig-create-random":
            CochonController::createRandomPigs($_GET);
            break;      

        case "admin_pig-delete":
            CochonController::askDeletePig($_GET);
            break;

        case "admin_pig-delete-base":
            CochonController::deletePig($_GET);
            break;

        case 'admin_pig-update-base':
            CochonController::updatePig($_POST, $_FILES);
            break;

        case "admin_pig-kill":
            CochonController::killAPig($_GET);
            break;
            
        default:
            SiteController::afficherHomePage($_GET);
            break;
    }    
}
else{
    //echo "erreur pas de rubrique";
    SiteController::afficherHomePage($_GET);
}