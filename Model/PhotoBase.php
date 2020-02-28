<?php

class PhotoBase {
    public function getMaxId($db){
        $sql = "select max(pho_id) as maxi from photo";
        $tmp = $db->query($sql);
        $rs = $tmp->fetchall();
        foreach ($rs as $max){
            $res = $max['maxi'];
        }
        return $res;
    }


    public function addPicture($db, $data){
        //$id = PhotoBase::getMaxId($db)+1;
        
        // add a picture
        $sql = "INSERT INTO photo (";
        $sql = $sql . " pho_id, pho_fichier, pho_titre, pho_created_at) VALUES";
        $sql = $sql . " (:id, :fichier, :titre, NOW() );";
        $ajt_pig = $db->prepare($sql);
        var_dump($ajt_pig);
        $res = $ajt_pig->execute($data);
        var_dump($data);
        return $res;
    }
}