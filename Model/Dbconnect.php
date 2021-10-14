<?php 
namespace media_library;

class Dbconnect {

protected static $_instance_db;

protected static $_typeUser = [1 => "administrateur", 2 => "employe", 3 => "user_subscriber"]; // property for control before insertion in bdd
protected static $_statutUser = ["non actif", "actif"];

public static function dateToFrench($date, $format) {
    $english_days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
    $french_days = array('lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche');
    $english_months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
    $french_months = array('janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre');
    return str_replace($english_months, $french_months, str_replace($english_days, $french_days, date($format, strtotime($date))));
}


    public function __construct(\PDO $db) {
        $this->setInstanceDb($db);
    }


    public function setInstanceDb($db) {
        if (is_null(self::$_instance_db)) {
        self::$_instance_db = $db;
        } else {
            return self::$_instance_db;
        }
    }


    public function testStringEntry($entry) {
        $item = strlen($entry);
        if (($item > 0) AND ($item < 200)) {
            return $entry;
        } else {
            header('Location: ' .$_SERVER["HTTP_REFERER"]);
            exit;
        }
    }


    public function testTextEntry($entry) {
        $item = strlen($entry);
        if (($item > 0) AND ($item < 1000)) {
            return $entry;
        } else {
            header('Location: ' .$_SERVER["HTTP_REFERER"]);
            exit;
        }
    }

}








