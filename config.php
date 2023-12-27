<?php

class Connect{
    public static function conexion()
    {
        $conexion = new mysqli('localhost', 'root', '', 'metroseguro');
        return $conexion;
    }

}





