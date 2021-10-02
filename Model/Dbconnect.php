<?php 
namespace media_library;

class Dbconnect {

protected static $_instance_db;
protected static $_typeUser = [1 => ["administrator", 1], ["editor", 2], ["user_subscriber", 3]]; // property for control before insertion in bdd

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


    public function testFileEntry($entry) {
        $extensionsImg = ['.png', '.jpg'];

        $entry = substr($entry, -4);

        for ($i = 0; $i < count($extensionsImg); $i++) {
            if (in_array($entry, $extensionsImg[$i])) {
                return true;
            } 
        }
        return false;
    }

}








