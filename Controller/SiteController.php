<?php 
//session_start();
//namespace Controller;

require_once 'vendor/autoload.php';
require_once 'Model/Database.php';
require_once 'Model/CouleurBase.php';
require_once 'Model/RaceBase.php';
require_once 'CochonController.php';
//use Database;

class SiteController {
       
    public static function afficherHomePage($req){
        // connexion à la base
        $db = new Database();
        $o_conn = $db->makeConnect();

        // on va chercher les cochons
        $couleur = "tous";
        $race = "tous";
        
        // le caroussel
        $cochons_carousel = CochonBase::getListeCochons($o_conn, $couleur, $race , 0, 2);      

        // les derniers
        $cochons_deniers = CochonBase::getListeCochons($o_conn, $couleur, $race , 2, 2);  

        

        //var_dump($cochons);
        //var_dump($cochons_carousel);

        // on créer et envoil le rendu
        $loader = new \Twig_loader_Filesystem('View/templates');
        $twig = new \Twig_Environment($loader, [
            'cache' => false,
        ]);
        echo $twig->render('index.html.twig',
                            ['cochons' => $cochons_deniers,
                            'carousel' => $cochons_carousel]
                        );
    }
    
    public static function displayOnglet1(){
        $loader = new \Twig_loader_Filesystem('View/templates');
        $twig = new \Twig_Environment($loader, [
            'cache' => false,
        ]);

        // connexion à la base
        $db = new Database();
        $o_conn = $db->makeConnect();

        // on va chercher la liste des couleurs
        $couleurs = CouleurBase::getCouleursActives($o_conn);

        // on va chercher la liste des races
        $races = RaceBase::getRacesActives($o_conn);



        echo $twig->render('onglet-1.html.twig',
                                ['couleurs' => $couleurs,
                                   'races' => $races]);
    }

    public static function displayOnglet2(){
        $loader = new \Twig_loader_Filesystem('View/templates');
        $twig = new \Twig_Environment($loader, [
            'cache' => false,
        ]);
        echo $twig->render('onglet-2.html.twig');
    }
    
    public static function displayFirm($tabGET){
        $loader = new \Twig_loader_Filesystem('View/templates');
        $twig = new \Twig_Environment($loader, [
            'cache' => false,
        ]);

        echo $twig->render('societe.html.twig',['rubrique' => $tabGET['rub']]);
    }

    public static function displayContact($tabGET){
        $loader = new \Twig_loader_Filesystem('View/templates');
        $twig = new \Twig_Environment($loader, [
            'cache' => false,
        ]);

        echo $twig->render('contact.html.twig',['rubrique' => $tabGET['rub']]);
    }

    public static function afficherPageConnexion($req){
        $loader = new \Twig_Loader_Filesystem('View/templates');
        $twig = new \Twig_Environment($loader, [
            'cache' => false,
        ]);
        echo $twig->render('admin/connexion.html.twig');

    }

    public static function authentification($req){
        //session_start();
        // recupe des données du formulaire 
        //print("dans authentification");
        //var_dump($req);
        // on prepare le renvoi
        $loader = new \Twig_Loader_Filesystem('View/templates');
        $twig = new \Twig_Environment($loader, [
            'cache' => false,
        ]);

        $login = $_POST['login'];
        $mdp = $_POST['mdp'];

        // connexion à la base
        $o_db = new Database();
        $o_conn = $o_db->makeConnect();

        if ($o_conn === false){
            echo "Echec de connexion";
        }   
        else {
            $o_rp = $o_conn->prepare("SELECT * FROM user where use_login =:login and use_mdp =:mdp;");
            $o_rp->bindParam(':login', $user);
            $o_rp->bindParam(':mdp' , $mdp);

            if ($o_rp->execute())
            {
                while ($row = $o_rp->fetchall())
                {
                    $login = $row["use_login"];
                    $_SESSION['admin'] = true;
                    $_SESSION['login'] = $login;
                    $twig->addGlobal('ses', $_SESSION);
                    $twig->addGlobal('login',$login);
                }

                CochonController::displayListOfPig($req);

                /*
                $loader = new \Twig\Loader\FilesystemLoader('View/templates');
                $twig = new \Twig\Environment($loader, [
                    'cache' => false,
                ]);
                $twig->addGlobal('login', $login);
                $oc = new CochonBase();
                $cochons = $oc->getCochonsActifs($o_conn);

                echo $twig->render('admin/admin_pig-list.html.twig', ['login' => $login, 'cochons' => $cochons ]);
            */
            }
            else {
                // utilisateur inconnu
                echo $twig->render('admin/admin_erreur.html.twig');
            }
        }      
    }
}