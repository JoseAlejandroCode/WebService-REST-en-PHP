<?php
/**
 * Insertar un nuevo customer
 */

require 'Customer.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	//Decodificando formado JSON
	$body = json_decode(file_get_contents("php://input"), true);

	// Insertar Customer
	$retorno = Customer::insert(
		$body['Customer_FirstName'],
		$body['Customer_SurName'],
		$body['Customer_Phone'],
		$body['Customer_Address'],
		$body['Customer_User'],
		$body['Customer_Passwor']
	);

	if ($retorno) {
		//Codigo de exito
		print json_encode(
			array(
				"estado" => "1",
				"mensaje" => "Creación exitosa"
			)
		);
	} else {
		//Codigo de falla
		print json_encode(
			array(
				"estado" => "2",
				"mensaje" => "Creación fallida"
			)
		);
	}
}