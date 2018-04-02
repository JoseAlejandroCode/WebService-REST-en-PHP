<?php
/**
 *  Actualiza un customer por su identificador
 */

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	//decodificado formato JSON
	$body = json_decode(file_get_contents("php://input"), true);

	// Actualizar Customer
	$retorno = Customer::update(
		$body['Customer_Id'],
		$body['Customer_FirstName'],
		$body['Customer_SurName'],
		$body['Customer_Phone'],
		$body['Customer_Address'],
		$body['Customer_User'],
		$body['Customer_Passwor']
	);

	if () {
		// Codigo de exito
		print json_encode(
			array(
				"estado" => "1",
				"mensaje" => "Actualización exitosa"
			)
		);
	} else {
		//Codigo de falla
		print json_encode(
			array(
				"estado" => "2",
				"mensaje" => "Actualización fallida"
			)
		);
	}

}