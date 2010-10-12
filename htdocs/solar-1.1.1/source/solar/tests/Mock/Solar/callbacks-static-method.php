<?php
class Solar_Callbacks_Static_Method {
    static public function callback()
    {
        $GLOBALS['SOLAR_CALLBACKS_STATIC_METHOD'] = true;
    }
}