<?php
/**
 * Obtiene todas las Menus de la base de datos
 */

require 'Menu.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    // Manejar petición GET
    $menus = Menu::getAll();

    if ($menus) {

        $datos["estado"] = 1;
        $datos["menus"] = $menus;

        print json_encode($datos);
    } else {
        print json_encode(array(
            "estado" => 2,
            "mensaje" => "Ha ocurrido un error"
        ));
    }
}