<?php
class CouleurBase{
    public static function getCouleursActives($db){
        $sql = "SELECT * FROM couleur;";
        $tmp_coul = $db->query($sql);
        $res = $tmp_coul->fetchall();
        //var_dump($res);
        return $res;
    }
}