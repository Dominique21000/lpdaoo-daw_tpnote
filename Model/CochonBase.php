<?php 
class CochonBase {

    /** @return the list of the cochon */
    public function getCochonsActifs($db, $sexeCochon, $ordreCochon, $sens, $nb, $debut){
        $sql = "SELECT t1.coc_id as id, t1.coc_nom as nom, t1.coc_poids as poids, ";
        $sql .= " t1.coc_date_naiss as date_naiss, ";
        $sql .= " t1.coc_duree_de_vie as duree_de_vie, t1.coc_deleted_at ,";
        // calcul de l'état : vrai pour vivant
        //$sql .= "DATEDIFF (now(), ";
        $sql .= " t1.coc_sexe as sexe, M.coc_nom as mere, ";
        $sql .= " P.coc_nom as pere ";
        $sql .= " FROM cochon as t1 ";

        // inner join pour les parents
        $sql .= "left JOIN Cochon as M ON M.coc_id = t1.coc_mere_id ";
        $sql .= "left JOIN Cochon as P ON P.coc_id = t1.coc_pere_id ";

        // pour le sexe du cochon
        switch ($sexeCochon) {
            case 'tous':
                $sql .= " WHERE t1.coc_deleted_at is NULL ";
                break;
            
            case 'male':
                $sql .= " WHERE t1.coc_sexe = 'Mâle' ";
                $sql .= " and t1.coc_deleted_at is NULL ";
                break;

            case 'femelle':
                $sql .= "WHERE t1.coc_sexe = 'Femelle' ";
                $sql .= " and t1.coc_deleted_at is NULL ";
                break;
        }

        // pour le sexe du cochon
        switch ($ordreCochon) {
            case 'nom':
                $sql .= "ORDER BY t1.coc_nom ";
                break;
            
            case 'poids':
                $sql .= "ORDER BY t1.coc_poids ";
                break;

            case 'date_naiss':
                $sql .= "ORDER BY t1.coc_date_naiss ";
                break;

            default:
                $sql .= "ORDER BY t1.coc_nom ";
            break;     
        }

        // pour le sexe du cochon
        switch ($sens) {
            case 'asc':
                $sql .= " ASC";
                break;
            
            case 'desc':
                $sql .= " DESC";
                break;
        }
        $sql .= " LIMIT " . $nb . " OFFSET " .$debut;

        $sql .= ";";
        //echo $sql;
        $tmp = $db->query($sql);
        $rs = $tmp->fetchall();
        return $rs;
    }

    /** @return the max of th id the the table cochon */
    public static function getMaxId($db){
        $sql = "select max(coc_id) as maxi from cochon";
        $tmp = $db->query($sql);
        $rs = $tmp->fetchall();
        foreach ($rs as $max){
            $res = $max['maxi'];
        }
        return $res;
    }


    /** add a pig in the table cochon */
    public function addPig($db, $data){
        $sql = "INSERT INTO cochon (";
        $sql = $sql . " coc_id, coc_nom, coc_poids, coc_sexe, coc_duree_de_vie, coc_date_naiss, coc_description, coc_pere_id, coc_mere_id, coc_created_at) VALUES";
        $sql = $sql . " ( :id, :nom, :poids, :sexe , :duree_vie, :date_naiss, :description, :pere, :mere, now() );";
        $ajt_pig = $db->prepare($sql);
        $res = $ajt_pig->execute($data);
        return $res;
    }

    /** update the info of a pig in the table cochon */
    public function updatePig($db, $data){
        $sql = "UPDATE cochon SET ";
        $sql .= "coc_nom = :nom, "; 
        $sql .= "coc_poids = :poids, ";
        $sql .= "coc_sexe = :sexe," ;
        $sql .= "coc_duree_de_vie = :duree_vie, ";
        $sql .= "coc_date_naiss = :date_naiss, ";
        $sql .= " coc_description = :description, ";
        $sql .= "coc_pere_id = :pere, ";
        $sql .= "coc_mere_id = :mere, ";
        $sql .= "coc_updated_at = now() "; 
        $sql .= " WHERE coc_id = :id";
        $update_pig = $db->prepare($sql);
        $res = $update_pig->execute($data);
        return $res;
    }

    /** @return the number of the pig women */
    public function getCountWomen($db){
        $sql = "select count(*) as nb_cochonnes from cochon ";
        $sql .= " where coc_sexe='Femelle'";
        $tmp = $db->query($sql);
        $rs = $tmp->fetchall();
        foreach ($rs as $cpt){
            $res = $cpt['nb_cochonnes'];
        }
        return $res;
    }

    /** @return the number the pig men */
    public function getCountMen($db){
        $sql = "select count(*) as nb_cochons from cochon ";
        $sql .= " where coc_sexe='Mâle'";
        $tmp = $db->query($sql);
        $rs = $tmp->fetchall();
        foreach ($rs as $cpt){
            $res = $cpt['nb_cochons'];
        }
        return $res;
    }

    /** @return the info of a pig in the table cochon */
    public function getPig($db, $id){
        $sql = "SELECT * FROM cochon ";
        $sql .= "WHERE coc_id = :id";
       
        $pig = $db->prepare($sql);
        $pig->bindParam(':id', $id, PDO::PARAM_INT);
        $pig->execute();
        $res = $pig->fetchall();
        return $res;
    }

    /** delete a pig from the database */
    public function deletePigBase($db, $id){
        $sql =" UPDATE cochon ";
        $sql .= " set coc_deleted_at = now() ";
        $sql .= " WHERE coc_id = :id;";
        $t_pig = $db->prepare($sql);
        $t_pig->bindParam(':id', $id, PDO::PARAM_INT);
        $res = $t_pig->execute();
        return $res;
    }

    /** @return the list of the pig women */
    public static function getWomens($db){
        $sql ="SELECT * FROM cochon where coc_sexe = 'Femelle'";
        $tmp = $db->query($sql);
        $rs = $tmp->fetchall();
        return $rs;
    }

    /** @return the list of the pig men  */
    public static function getMens($db){
        $sql ="SELECT * FROM cochon where coc_sexe = 'Mâle'";
        $tmp = $db->query($sql);
        $rs = $tmp->fetchall();
        return $rs;
    }

    /** @return les id of the pig Mâle */
    public function getIdCochons($db)
    {
        $sql ="SELECT coc_id FROM cochon where coc_sexe = 'Mâle'";
        $tmp = $db->query($sql);
        $rs = $tmp->fetchall();
        return $rs;
    } 

    /** @return the id of the pig Femelle */
    public function getIdCochonnes($db){
        $sql ="SELECT coc_id FROM cochon where coc_sexe = 'Femelle'";
        $tmp = $db->query($sql);
        $rs = $tmp->fetchall();
        return $rs;
    }

    /** let us to kill a pig
     * its update the duration of life
     */
    public function updateDdV($db, $data){
        // on veut que ça soit dit que le cochon meur ce jour 
        // => 
        // on met la duree de vie à 
        // différence entre 
        //  now et date_naiss
        $duration = CochonBase::getDurationOFLifeIfKillNow($db, $data);
        $sql = "UPDATE cochon ";
        $sql .= "SET coc_duree_de_vie = ". $duration;
        $sql .= " where coc_id = :id";
        //$sql .= " ";
        $t_k_pig = $db->prepare($sql);
        //var_dump($t_k_pig);
        $res = $t_k_pig->execute($data);
        return $res;
    }

    public static function getDurationOFLifeIfKillNow($db, $data){
        //$sql = "SELECT DATEDIFF(NOW(),";
        //$sql .= "(SELECT coc_date_naiss from cochon where coc_id = :id) as duree_de_vie_reelle ";
        //$sql .= " FROM cochon";
        //$sql .= " WHERE coc_id =:id";
        $sql = " SELECT DATEDIFF( ";
        $sql .= " NOW(),";                
        $sql .= " (SELECT ";
        $sql .= " coc_date_naiss "; 
        $sql .= " FROM ";
        $sql .= " cochon "; 
        $sql .= " WHERE ";
        $sql .= " coc_id = :id)";
        $sql .= " ) as a_vivre ";
        $sql .= " from cochon ";
        $sql .= " where coc_id = :id";
        
        $t_g_d_pig = $db->prepare($sql);
        //var_dump($t_g_d_pig);
        $tmp = $t_g_d_pig->execute($data);
        $res = $t_g_d_pig->fetchall();
        //print($res[0][0]);
        return $res[0][0];        
    }    
}