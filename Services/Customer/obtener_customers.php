<?php
/**
 * Obtiene todos los Customers de la base de datos
 */

require 'Customer.php';

if($_SERVER['REQUEST_METHOD'] == 'GET') {

	//Manejar peticion GET
	$customers = Customer::getAll();

	if ($customers) {

		$datos["estado"] = 1;
		$datos["customers"] = $customers;

		print json_encode($datos);

	} else {
		print json_encode(
			array(
				"estado" => "2",
				"mensaje" => "Ha ocurrido un error"
			)
		);
	}
}