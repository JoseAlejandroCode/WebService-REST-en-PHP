<?php
/**
 * 
 */

require 'Customer.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

	if (isset($_GET['Customer_Id'])) {

		//Obtener parametro Customer_Id
		$parametro = $_GET['Customer_Id'];

		//Tratar retorno
		$retorno = Customer::getById($parametro);

		if ($retorno) {

			$customer["estado"] = "1";
			$customer["customer"] = $retorno;

			//Enviar objeto json del Customer
			print json_encode($customer);
		} else {
			// Enviar respuesta de error general
			print json_encode(
				array(
					"estado" => "2",
					"mensaje" => "No se obtuvo el registro"
				);
			);
		}
	} else {
		//Enviar respuesta de error 
		print json_encode(
			array(
				"estado" => "3",
				"mensaje" => "Se necesita identificador"
			)
		);
	}	
} 