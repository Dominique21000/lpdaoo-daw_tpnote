<?php 
class CochonBase {

    // give the list of the cochon
    public function getCochonsActifs($db, $sexeCochon, $ordreCochon, $sens, $nb, $debut){
        $sql = "SELECT t1.coc_id as id, t1.coc_nom as nom, t1.coc_poids as poids, t1.coc_duree_de_vie as duree_de_vie, 
        t1.coc_date_naiss as date_naiss, t1.coc_sexe as sexe, M.coc_nom as mere, P.coc_nom as pere FROM cochon as t1 ";

        

        // inner join pour les parents
        $sql .= "left JOIN Cochon as M ON M.coc_id = t1.coc_mere_id ";
        $sql .= "left JOIN Cochon as P ON P.coc_id = t1.coc_pere_id ";

        // pour le sexe du cochon
        switch ($sexeCochon) {
            case 'tous':
                break;
            
            case 'male':
                $sql .= "WHERE t1.coc_sexe = 'Mâle' ";
                break;

            case 'femelle':
                $sql .= "WHERE t1.coc_sexe = 'Femelle' ";
                break;
        }

        // pour selectionner les actifs
        $sql .= " and t1.coc_deleted_at is null ";


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
        //echo "sql " . $sql;
        $tmp = $db->query($sql);
        $rs = $tmp->fetchall();
        return $rs;
    }

   
    public static function getMaxId($db){
        $sql = "select max(coc_id) as maxi from cochon";
        $tmp = $db->query($sql);
        $rs = $tmp->fetchall();
        foreach ($rs as $max){
            $res = $max['maxi'];
        }
        return $res;
    }


    public function addPig($db, $data){
        //print("dans addPig");
        // add a pig
        $sql = "INSERT INTO cochon (";
        $sql = $sql . " coc_id, coc_nom, coc_poids, coc_sexe, coc_duree_de_vie, coc_date_naiss, coc_pere_id, coc_mere_id, coc_created_at) VALUES";
        $sql = $sql . " ( :id, :nom, :poids, :sexe , :duree_vie, :date_naiss, :pere, :mere, now() );";
        $ajt_pig = $db->prepare($sql);
        $res = $ajt_pig->execute($data);
        //var_dump($ajt_pig);
        //echo "id : " .$data[':id'];
        //var_dump($data);
        return $res;
    }

    public function updatePig($db, $data){
        // update a pig
        var_dump($data);
        $sql = "UPDATE cochon SET ";
        $sql = $sql . "coc_nom = :nom, "; 
        $sql = $sql . "coc_poids = :poids, ";
        $sql = $sql . "coc_sexe = :sexe," ;
        $sql = $sql . "coc_duree_de_vie = :duree_vie, ";
        $sql = $sql . "coc_date_naiss = :date_naiss, ";
        $sql = $sql . "coc_pere_id = :pere, ";
        $sql = $sql . "coc_mere_id = :mere, ";
        $sql = $sql . "coc_updated_at = now() "; 
        $sql = $sql . " WHERE coc_id = :id";
        $update_pig = $db->prepare($sql);
        var_dump($update_pig);
        $res = $update_pig->execute($data);
        return $res;
    }

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

    public function getPig($db, $id){
        $sql = "SELECT * FROM cochon ";
        $sql .= "WHERE coc_id = :id";
       
        $pig = $db->prepare($sql);
        $pig->bindParam(':id', $id, PDO::PARAM_INT);
        $pig->execute();
        $res = $pig->fetchall();
        return $res;
    }

    public function deletePigBase($db, $id){
        $sql =" UPDATE cochon ";
        $sql .= " set coc_deleted_at = now() ";
        $sql .= " WHERE coc_id = :id;";
        $t_pig = $db->prepare($sql);
        $t_pig->bindParam(':id', $id, PDO::PARAM_INT);
        $res = $t_pig->execute();
        return $res;
    }

    public static function getWomens($db){
        $sql ="SELECT * FROM cochon where coc_sexe = 'Femelle'";
        $tmp = $db->query($sql);
        $rs = $tmp->fetchall();
        return $rs;
    }

    public static function getMens($db){
        $sql ="SELECT * FROM cochon where coc_sexe = 'Mâle'";
        $tmp = $db->query($sql);
        $rs = $tmp->fetchall();
        return $rs;
    }

    public function getIdCochons($db)
    {
        $sql ="SELECT coc_id FROM cochon where coc_sexe = 'Mâle'";
        $tmp = $db->query($sql);
        $rs = $tmp->fetchall();
        return $rs;
    } 

    public function getIdCochonnes($db){
        $sql ="SELECT coc_id FROM cochon where coc_sexe = 'Femelle'";
        $tmp = $db->query($sql);
        $rs = $tmp->fetchall();
        return $rs;
    }
}
