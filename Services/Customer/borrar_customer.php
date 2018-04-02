<?php
/**
 * Elimina un Customer de la base de datos
 * distinguida por su identificador
 */

require 'Customer.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	//Decodificando formato JSON
	$body = json_decode(file_get_contents("php://input"), true);

	$retorno = Customer::delete($body['Customer_Id']);

	if ($retorno) {
		print json_encode(
			array(
				'estado' => '1',
				'mensaje' => 'Eliminación exitosa'
			)
		);
	} else {
		print json_encode(
			array(
				'estado' => '2',
				'mensaje' => 'Eliminación fallida'
			)
		);
	}
}