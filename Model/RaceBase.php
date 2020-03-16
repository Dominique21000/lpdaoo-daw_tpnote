<?php
class RaceBase{
    public static function getRacesActives($db){
        $sql = "SELECT * FROM race;";
        $tmp_race = $db->query($sql);
        $res = $tmp_race->fetchall();
        return $res;        
    }
}