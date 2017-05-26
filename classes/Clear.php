<?php

class Clear {

    public static function clearHtml($x) {

        if (!isset($x))
            return null;
        elseif (is_string($x))
            return htmlspecialchars($x, ENT_QUOTES);
        elseif (is_array($x))
        {
            foreach($x as $k => $v)
            {
                $x[$k] = self::clearHtml($v);
            }
            return $x;
        } elseif(is_object($x)) {

            $x = (array) $x;

            foreach($x as $k => $v)
            {
                $x[$k] = self::clearHtml($v);
            }
            return (object) $x;
        }
        else
            return $x;

    }

}