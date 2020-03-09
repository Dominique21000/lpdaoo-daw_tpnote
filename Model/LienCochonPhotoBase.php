<?php 

class LienCochonPhotoBase {
    /** @return the max id of the table lien_cochon_photo */
    public function getMaxId($db){
        $sql = "select max(lcp_id) as maxi from lien_cochon_photo";
        $tmp = $db->query($sql);
        $rs = $tmp->fetchall();
        foreach ($rs as $max){
            $res = $max['maxi'];
        }
        return $res;
    }

    /** add a link between a pig and a picture */
    public function addLink($db, $data){
        $sql = "INSERT INTO lien_cochon_photo (";
        $sql .= " lcp_id, lcp_coc_id, lcp_pho_id, lcp_created_at) VALUES";
        $sql .= " ( :id, :coc_id, :pho_id, now() );";
        $ajt_pig = $db->prepare($sql);
        $res = $ajt_pig->execute($data);
        return $res;
    }  
}