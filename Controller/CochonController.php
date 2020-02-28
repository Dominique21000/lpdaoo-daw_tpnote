<?php

require_once 'Model/Database.php';
require_once 'Model/CochonBase.php';
require_once 'Model/Photo.php';
require_once 'Model/PhotoBase.php';
require_once 'Model/LienCochonPhotoBase.php';

class CochonController{

    /** function which manage the list of the pig */
    public static function displayListOfPig($tabGET){
        // la connexion à la base
        $o_pdo =  new Database();
        $o_conn = $o_pdo->makeConnect();
        // recuperation de la liste des cochons 
        $cb = new CochonBase();

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
        $nb_epp = 5; 
        if (isset($tabGET['nb_epp'])) $nb_epp = $tabGET['nb_epp'];

        // recup no_page
        $page = 0; 
        if (isset($tabGET['page'])) $page = $tabGET['page'];

        // Comptabilisation
        $nb_cochonnes = $cb->getCountWomen($o_conn);
        $nb_cochons = $cb->getCountMen($o_conn);
        $nb_total = $nb_cochons + $nb_cochonnes;
      
        // pour pagination
        $nb_pages = 1;
        if (($nb_total % $nb_epp ) == 0) 
        {
            $nb_pages = (int)($nb_total / $nb_epp); 
        }
        else{
            $nb_pages = (int)($nb_total / $nb_epp) +1;
        }

        $debut = 0;
        if ($page > 1){
            $debut = ($page - 1) * $nb_epp ;
        }

        
        $cochons = $cb->getCochonsActifs($o_conn, $sexeCochon, $ordreCochon, $sens, $nb_epp, $debut);

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
                                                             'nb_epp' => $nb_epp,
                                                             'nb_pages' => $nb_pages, ]
                                                            );
    }    


    /**  mange the form for adding a pig in the database */
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



    //****************************************** */
    // AJOUT //
    /** manage the add of a pig in the database */
    public static function addPigBase($tabPost, $tabFile){
        // la connexion à la base
        $o_pdo =  new Database();
        $o_conn = $o_pdo->makeConnect();
       
        // ajout dans les tables
        // cochon
        $cb = new CochonBase();
        $id_cochon = CochonBase::getMaxId($o_conn)+1;
        $data_cochon = array(
            ':id' => $id_cochon,
            ':nom' => $tabPost['nom'],
            ':poids' => intval($tabPost['poids']),
            ':sexe' => $tabPost['sexe'],
            ':duree_vie' => $tabPost['duree_de_vie'],
            ':date_naiss' => $tabPost['date_naiss'],           
            ':mere' => intval($tabPost['mere']),    
            ':pere' => intval($tabPost['pere']),            
        );
               
        $addCochon = $cb->addPig($o_conn, $data_cochon);
        //var_dump($addCochon);
        
        // photo
        $pb = new PhotoBase();
        for ($cpt_photo = 1; $cpt_photo <= 5 ; $cpt_photo ++)
        {
            //print("<br>" . $cpt_photo."<br>");
            // trt pour chaque photo
            $id_photo = intval($pb->getMaxId($o_conn) +1);

            // pour le fichier
            // pour l'ajout de l'extension
            //var_dump($tabPost);

            //var_dump($tabFile['picture_1']);

            if ($tabFile['picture_'.$cpt_photo]['type'] == "image/jpeg")        
            {
                $extension = ".jpeg";
            }
            if ($tabFile['picture_'.$cpt_photo]['type'] =="image/png"){
                $extension = ".png";
            }

            $data_photo = array(
                ':id' => $id_photo,
                ':titre' => $tabPost['titre_' . $cpt_photo],
                ':fichier' => $id_photo . $extension,
            );
            //echo "id : ".$id_photo."<br>";
            //var_dump($data_photo);
            $n_photo = $pb->addPicture($o_conn, $data_photo);
            //var_dump($n_photo);
        }
       

        // lien
        $lcpb = new LienCochonPhotoBase();
        $id_lien = intval($lcpb->getMaxId($o_conn) +1);
        $data_lien = array(
            ':id' => $id_lien,
            ':coc_id' => $id_cochon,
            ':pho_id' => $id_photo, 
        ); 
        print("<br>");
        var_dump($data_lien);
        $n_lien = $lcpb->addLink($o_conn, $data_lien);
        print("ok ? <br>");
        var_dump($n_lien);


        $loader = new \Twig\Loader\FilesystemLoader('View/templates');
        $twig = new \Twig\Environment($loader, [
            'cache' => false,
        ]);
     
        
        if ($addCochon == true && $n_photo == true && $n_lien==true)
        {
            // traitelent des fichiers
            Photo::savePhoto($tabFile, 'picture_1', $id);
            Photo::savePhoto($tabFile, 'picture_2', $id);
            Photo::savePhoto($tabFile, 'picture_3', $id);
            Photo::savePhoto($tabFile, 'picture_4', $id);
            Photo::savePhoto($tabFile, 'picture_5', $id);

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

    /** ask the confirmation for deleting a pig in the database */
    public static function askDeletePig($tabGET){
        $id = $tabGET['pig'];
        // geting the details
        // la connexion à la base
        $o_pdo =  new Database();
        $o_conn = $o_pdo->makeConnect();
        $cb = new CochonBase();
        $p = $cb->getPig($o_conn,$id);
        $nom = $p[0]["coc_nom"];
        //var_dump($p);
        //echo "nom : " .$nom;

        $loader = new \Twig\Loader\FilesystemLoader('View/templates');
        $twig = new \Twig\Environment($loader, [
            'cache' => false,
        ]);
      
        echo $twig->render('admin/admin_pig-ask-delete.html.twig', 
                            ['id' => $id,
                            'nom' => $nom]);
    }

    /** delete a pig from a database */
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

    /** update of the database with the new information */
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

    /** creation aléatoire de 10 cochons dans la base
     * on prend un tableau de prénom
     * on choisit ensuite les élements de façons aléatoires
     */
    public static function createPigBase(){
        // la connexion à la base
        $o_pdo =  new Database();
        $o_conn = $o_pdo->makeConnect();
        $cb = new CochonBase();

        $prenom_masculin = array(0=>"Albert", 1=>"Achille", 2=>"Adam", 3=>"Adolphe", 4=>"André", 
                                5=>"Alphonse", 6=>"Amadeus", 7=>"Aristide", 8=>"Armand", 9=>"Aurélien", 
                                10=>"Bernard",11=>"Bertrand", 12=>"Barthelemy", 13=>"Brian", 14=>"Benoît",
                                15=>"Boniface", 16=>"Boris", 17=>"Brandon", 18=>"Marc" , 19=>"Morgan" );


        $prenom_feminin = array(0=>"Adèle", 1=>"Adriana", 2=>"Agathe", 3=>"Agnès", 4=>"Agripine", 
                                5=>"Alice", 6=>"Alvina", 7=>"Ambre", 8=>"Annabelle", 9=>"Annaëlle", 
                                10=>"Apolline", 11=>"Ariane", 12=>"Armelle", 13=>"Astrid", 14=>"Barbara" ,
                                15=>"Béatrice", 16=>"Bélinda", 17=>"Bénédicte", 18=>"Bernadette", 19=>"Bess",
                                20=>"Betty",21=> "Blanche");
            
        $tabSexe = array(0 => "Femelle",
                        1 => "Mâle");


        // genration des cochons             
        for ($cpt_cochons = 1; $cpt_cochons <= 10; $cpt_cochons ++){
            $sexe = $tabSexe[random_int(0,count($tabSexe)-1)];
        if ($sexe == "Mâle"){
            $prenom = $prenom_masculin[ random_int(0,count($prenom_masculin) -1)] ;
        }
        else{
            $prenom = $prenom_feminin [ random_int(0,count($prenom_feminin) -1) ];
        }
        
        // generation de la date de naissance
        $annee = random_int(1960, 2019);
        $mois = random_int(1,12);
        $jour = random_int(1, 28);
        $heure = random_int(0,23);
        $min = random_int(0, 59);
        $sec = random_int(0, 59);
        $date_naissance = $annee . "-" . $mois . "-" . $jour . " " .$heure . ":" . $min . ":" . $sec;
        
        $mere = random_int( 0, count( $cb->getIdCochonnes($o_conn)) );
        $pere = random_int(0, count($cb->getIdCochons($o_conn)));
        
        $poids = random_int(250000, 360000);
        

        $duree_vie = random_int(15*365, 20*365);
        
        // add of the pig in the db
        $data = array(':nom'=> $prenom,
                     ':poids'=>$poids,
                     ':sexe' => $sexe, 
                     ':duree_vie' => $duree_vie, 
                     ':date_naiss' => $date_naissance, 
                     ':pere' =>$pere,
                     ':mere' => $mere);
        $retour = $cb->addPig($o_conn, $data);        
        }   
        
        // renvoi de la réponse
        $loader = new \Twig\Loader\FilesystemLoader('View/templates');
        $twig = new \Twig\Environment($loader, [
            'cache' => false,
        ]);
        if ($retour == 1){
            echo $twig->render('admin/admin_pig-result.html.twig', 
            ['type' => 'add-lot',
            'value' => 'ok']);
        } 
        else{
            // erreur
            echo $twig->render('admin/admin_pig-result.html.twig', 
                            ['type' => 'add-lot',
                            'value'=> 'erreur']);   
        }

    } 
}