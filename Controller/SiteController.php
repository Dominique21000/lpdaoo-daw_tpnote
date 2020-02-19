<?php 
//session_start();
//namespace Controller;

require_once 'vendor/autoload.php';
require_once 'Model/Database.php';
require_once 'CochonController.php';
//use Database;

class SiteController {
       
    public static function afficherHomePage($req){
        $loader = new \Twig\Loader\FilesystemLoader('View/templates');
        $twig = new \Twig\Environment($loader, [
            'cache' => false,
        ]);

        echo $twig->render('index.html.twig');
    }
    

    public static function afficherPageConnexion($req){
        $loader = new \Twig\Loader\FilesystemLoader('View/templates');
        $twig = new \Twig\Environment($loader, [
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
        $loader = new \Twig\Loader\FilesystemLoader('View/templates');
        $twig = new \Twig\Environment($loader, [
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