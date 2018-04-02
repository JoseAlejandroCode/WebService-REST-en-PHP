<?php

require '../../Connection/Database.php';

class Customer 
{
	function __construct()
	{

	}

	/**
	 * 
	 */
	
	public static function getAll()
	{
		$consulta = "SELECT Customer_Id, 
							Customer_FirstName,
							Customer_SurName,
							Customer_Phone,
							Customer_Address,
							Customer_User,
							Customer_Password FROM Customer";
		try {
			// Preparar sentecia
			$comando = Database::getInstance()->getDb()->prepare($consulta);
			// Ejecutar sentencia preparada
			$comando->execute();

			return $comando->fetchAll(PDO::FETCH_ASSOC);

		} catch (PDOException $e) {
			return false;
		}
	}

	/**
	 * 
	 */

	public static function getById($Customer_Id)
	{
		$consulta = "SELECT Customer_Id, 
							Customer_FirstName,
							Customer_SurName,
							Customer_Phone,
							Customer_Address,
							Customer_User,
							Customer_Password FROM Customer
							WHERE Customer_Id = ?";
		try {
			//Preparar la sentencia
			$comando = Database::getInstance()->getDb()->prepare($consulta);
			//Ejecutar sentencia preparada
			$comando->execute(array($Customer_Id));
			//Capturar primera fila del resultado
			$row = $comando->fetch(PDO::FETCH_ASSOC);
			return $row;

		} catch (PDOException $e) {
			// Aquí puedes clasificar el error dependiendo de la excepción
            // para presentarlo en la respuesta Json
            return -1;
		}
	}

	/**
	 * 
	 */
	
	public static function update(
		$Customer_Id, 
		$Customer_FirstName,
		$Customer_SurName,
		$Customer_Phone,
		$Customer_Address,
		$Customer_User,
		$Customer_Password
	)
	{
		// Creando consulta update
		$consulta = "UPDATE Customer" .
				"SET Customer_FirstName = IFNULL(?,Customer_FirstName)," .
				"Customer_SurName = IFNULL(?,Customer_SurName)," .
				"Customer_Phone = IFNULL(?,Customer_Phone)," .
				"Customer_Address = IFNULL(?,Customer_Address)," .
				"Customer_User = IFNULL(?,Customer_User)," .
				"Customer_Password = IFNULL(?,Customer_Password)" .
				"WHERE Customer_Id = ?";

		//Preparar Consulta UPDATE
		$cmd = Database::getInstance()->getDb()->prepare($consulta);

		// Relacioanr y ejecitar la sentencia
		$cmd->execute(array($Customer_FirstName, $Customer_SurName, $Customer_Phone, $Customer_Address, $Customer_User, $Customer_Password, $Customer_Id));

		return $cmd;
	}

	/**
	 * 
	 */

	public static function insert(
		$Customer_FirstName,
		$Customer_SurName,
		$Customer_Phone,
		$Customer_Address,
		$Customer_User,
		$Customer_Password
	)
	{
		//Sentencia INSERT
		$sentencia = "INSERT INTO Customer ( " .
					"Customer_FirstName," .
					"Customer_SurName," .
					"Customer_Phone," .
					"Customer_Address," .
					"Customer_User," .
					"Customer_Password)" .
					"VALUES (?,?,?,?,?,?)";

		//Preparar la sentencia
		$comando = Database::getInstance()->getDb()->prepare($sentencia);

		return $comando->execute(
			array(
				$Customer_FirstName,
				$Customer_SurName,
				$Customer_Phone,
				$Customer_Address,
				$Customer_User,
				$Customer_Password
			)
		);
	}

	/**
	 * 
	 */
	
	public static function delete($Customer_Id)
	{
		//Sentencia DELETE
		$comando = "DELETE FROM Customer WHERE Customer_Id = ?";

		//Preparar la sentencia
		$sentencia = Database::getInstance()->getDb()->prepare($comando);

		return $sentecia->execute(array($Customer_Id));
	}

}

?>