<?php

class PhotoBase {
    /** @return the max id fom the table photo */
    public function getMaxId($db){
        $sql = "select max(pho_id) as maxi from photo";
        $tmp = $db->query($sql);
        $rs = $tmp->fetchall();
        foreach ($rs as $max){
            $res = $max['maxi'];
        }
        return $res;
    }

    /** add a picture in the database*/
    public function addPicture($db, $data){
        //$id = PhotoBase::getMaxId($db)+1;
        
        // add a picture
        $sql = "INSERT INTO photo (";
        $sql = $sql . " pho_id, pho_fichier, pho_titre, pho_default, pho_created_at) VALUES";
        $sql = $sql . " (:id, :fichier, :titre, :default,  NOW() );";
        $ajt_pig = $db->prepare($sql);
        //var_dump($ajt_pig);
        $res = $ajt_pig->execute($data);
        //var_dump($data);
        return $res;
    }

    /** give the photo of the cochon  */
    public static function getPictures($db, $data){
        $sql = "SELECT photo.pho_id, photo.pho_titre, photo.pho_fichier ";
        $sql .= " FROM lien_cochon_photo ";
        $sql .= " INNER JOIN photo on lien_cochon_photo.lcp_pho_id = photo.pho_id ";
        $sql .= " WHERE lien_cochon_photo.lcp_coc_id = :coc_id ";
        $sql .= " and pho_deleted_at is NULL ";
        $sql .= " ORDER BY pho_id";
        $get_pic = $db->prepare($sql);

        $get_pic->execute($data);
        $res = $get_pic->fetchall();
        return $res;
    }

    /** update a picture in the database*/
    public function updatePicture($db, $data){
        // update a picture
        $sql = "UPDATE photo set ";
        $sql .= " pho_fichier = :fichier ,";
        $sql .= " pho_titre = :titre, ";
        $sql .= " pho_updated_at = now() ";
        $sql .= " WHERE pho_id = :id";
        $upd_pig = $db->prepare($sql);
        $res = $upd_pig->execute($data);
        return $res;
    }
}