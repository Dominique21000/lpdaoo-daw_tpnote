<?php

require_once 'Model/Database.php';
require_once 'Model/CochonBase.php';

class CochonController{

    public static function displayListOfPig($tabGET){
        // la connexion à la base
        $o_pdo =  new Database();
        $o_conn = $o_pdo->makeConnect();

        // choix du sexe à afficher
        $sexeCochon = "tous"; 
        if (isset($tabGET['sexe'])) $sexeCochon = $tabGET['sexe'];
        
        // ordre à afficher
        $ordreCochon = "nom";
        if (isset($tabGET['ordre'])) $ordreCochon = $tabGET['ordre'];
        
        // sens
        $sens = "asc";
        if (isset($tabGET['sens'])) $sens = $tabGET['sens'];
        
        // pour pagination
        $nb_elements = 5; 
        if (isset($tabGET['nb_elements'])) $nb_elements = $tabGET['nb_elements'];


        // recuperation de la liste des cochons 
        $cb = new CochonBase();
        $cochons = $cb->getCochonsActifs($o_conn, $sexeCochon, $ordreCochon, $sens);

        // Comptabilisation
        $nb_cochonnes = $cb->getCountWomen($o_conn);
        $nb_cochons = $cb->getCountMen($o_conn);
      

        //return $cochons;
        $loader = new \Twig\Loader\FilesystemLoader('View/templates');
        $twig = new \Twig\Environment($loader, [
            'cache' => false,
        ]);
      
        echo $twig->render('admin/admin_pig-list.html.twig', ['cochons' => $cochons,
                                                             'session' => $_SESSION,
                                                             'nb_cochonnes' => $nb_cochonnes,
                                                             'nb_cochons' => $nb_cochons,
                                                             'sexe' => $sexeCochon,
                                                             'ordre' => $ordreCochon,
                                                             'sens' => $sens,
                                                             'nb_elements' => $nb_elements]);
    }    

    public static function addUpdatePigForm($tabGET){
        
        $o_pdo =  new Database();
        $o_conn = $o_pdo->makeConnect();

        // get the list of the mothers
        $womens = CochonBase::getWomens($o_conn);
        //var_dump($mothers);
        //echo "fin de mothers";

        // get the list of the fathers
        $mens = CochonBase::getMens($o_conn);

        $id = -1;
        $myPig = [];
        if (isset($tabGET['pig'])){
            $id = $tabGET['pig'];

            // get the details of the cochon
             // la connexion à la base
            
            $cb = new CochonBase();
            $myPig = $cb->getPig($o_conn, $id);

        }

        $loader = new \Twig\Loader\FilesystemLoader('View/templates');
        $twig = new \Twig\Environment($loader, [
            'cache' => false,
        ]);
        echo $twig->render('admin/admin_pig-add-update.html.twig', 
                                ['session' => $_SESSION,
                                'id' => $id,
                                'pig' => $myPig,
                                'womens' => $womens,
                                'mens' => $mens ]);
    }

    public static function addPigBase($tabPost){
        //var_dump($tabPost);
        $data = array(
            ':nom' => $tabPost['nom'],
            ':poids' => $tabPost['poids'],
            ':duree_vie' => $tabPost['duree_de_vie'],
            ':date_naiss' => $tabPost['date_naiss'],
            ':sexe' => $tabPost['sexe'],
            ':mere' => $tabPost['mere'],    
            ':pere' => $tabPost['pere'],            
        );

        // la connexion à la base
        $o_pdo =  new Database();
        $o_conn = $o_pdo->makeConnect();
        $cb = new CochonBase();
        $addCochon = $cb->addPig($o_conn, $data);
        var_dump($addCochon);

        $loader = new \Twig\Loader\FilesystemLoader('View/templates');
        $twig = new \Twig\Environment($loader, [
            'cache' => false,
        ]);
     
        if ($addCochon == 1)
        {
            // ok
            echo $twig->render('admin/admin_pig-result.html.twig', 
                            ['type' => 'add',
                            'value' => 'ok']);
        }
        else{
            // erreur
            echo $twig->render('admin/admin_pig-result.html.twig', 
                            ['type' => 'add']);
        }    
    }

    public static function askDeletePig($tabGET){
        $id = $tabGET['pig'];
        // geting the details
        // la connexion à la base
        $o_pdo =  new Database();
        $o_conn = $o_pdo->makeConnect();
        $cb = new CochonBase();
        $p = $cb->getPig($o_conn,$id);
        $nom = $p[0]["coc_nom"];
        var_dump($p);
        echo "nom : " .$nom;

        $loader = new \Twig\Loader\FilesystemLoader('View/templates');
        $twig = new \Twig\Environment($loader, [
            'cache' => false,
        ]);
      
        echo $twig->render('admin/admin_pig-ask-delete.html.twig', 
                            ['id' => $id,
                            'nom' => $nom]);
    }

    public static function deletePig($tabGET){
        $id=$tabGET['id'];
        
        // la connexion à la base
        $o_pdo =  new Database();
        $o_conn = $o_pdo->makeConnect();
        $cb = new CochonBase();

        $loader = new \Twig\Loader\FilesystemLoader('View/templates');
        $twig = new \Twig\Environment($loader, [
            'cache' => false,
            ]);

        if ($cb->deletePigBase($o_conn, $id) == 1)
        {
            // ok
            echo $twig->render('admin/admin_pig-result.html.twig', 
                            ['type' => 'delete',
                            'value' => 'ok']);
        }
        else{
            // erreur
            echo $twig->render('admin/admin_error.html.twig', 
                            ['type' => 'delete']);
        }
    }

    public static function updatePig($tabPost){
        $data = array(
            ':id' => $tabPost['id'],
            ':nom' => $tabPost['nom'],
            ':poids' => $tabPost['poids'],
            ':duree_vie' => $tabPost['duree_de_vie'],
            ':date_naiss' => $tabPost['date_naiss'],
            ':sexe' => $tabPost['sexe'],
            ':mere' => $tabPost['mere'],    
            ':pere' => $tabPost['pere'],            
        );

        // la connexion à la base
        $o_pdo =  new Database();
        $o_conn = $o_pdo->makeConnect();
        $cb = new CochonBase();
        $updtPig = $cb->updatePig($o_conn, $data);
        var_dump($updtPig);

        $loader = new \Twig\Loader\FilesystemLoader('View/templates');
        $twig = new \Twig\Environment($loader, [
            'cache' => false,
        ]);
     
        if ($updtPig == true)
        {
            // ok
            echo $twig->render('admin/admin_pig-result.html.twig', 
                            ['type' => 'update',
                            'value' => 'ok']);
        }
        else{
            // erreur
            echo $twig->render('admin/admin_pig-result.html.twig', 
                            ['type' => 'update']);
        }
    }
}