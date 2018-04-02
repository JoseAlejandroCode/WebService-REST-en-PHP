<?php
/**
 * Obtiene el detalle de un menu especificado por
 * su identificador "Menu_Id"
 */

require 'Menu.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (isset($_GET['Menu_Id'])) {

        // Obtener parámetro Menu_Id
        $parametro = $_GET['Menu_Id'];

        // Tratar retorno
        $retorno = Menu::getById($parametro);


        if ($retorno) {

            $menu["estado"] = "1";
            $menu["menu"] = $retorno;
            // Enviar objeto json de la menu
            print json_encode($menu);
        } else {
            // Enviar respuesta de error general
            print json_encode(
                array(
                    'estado' => '2',
                    'mensaje' => 'No se obtuvo el registro'
                )
            );
        }

    } else {
        // Enviar respuesta de error
        print json_encode(
            array(
                'estado' => '3',
                'mensaje' => 'Se necesita un identificador'
            )
        );
    }
}