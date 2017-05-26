<?php

class AutoLoader {

    public static function load($class) {

        if(!include ("classes/$class.php")) {
            header('Content-Type: text/html; charset=utf-8');
            throw new ErrorException("Chyba pri nacitani tridy $class");
        }
    }
}