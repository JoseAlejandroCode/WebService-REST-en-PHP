<?php

/**
 * Representa el la estructura de las Menus
 * almacenadas en la base de datos
 */
require '../../Connection/Database.php';

class Menu
{
    function __construct()
    {
    }

    /**
     * Retorna en la fila especificada de la tabla 'Menu'
     *
     * @param $idMenu Identificador del registro
     * @return array Datos del registro
     */
    public static function getAll()
    {
        $consulta = "SELECT Menu_Id,
                            Menu_Name FROM Menu";
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute();

            return $comando->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Obtiene los campos de un Menu con un identificador
     * determinado
     *
     * @param $Menu_Id Identificador del Menu
     * @return mixed
     */
    public static function getById($Menu_Id)
    {
        // Consulta de la Menu
        $consulta = "SELECT Menu_Id,
                            Menu_Name
                             FROM Menu
                             WHERE Menu_Id = ?";

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($Menu_Id));
            // Capturar primera fila del resultado
            $row = $comando->fetch(PDO::FETCH_ASSOC);
            return $row;

        } catch (PDOException $e) {
            // Aquí puedes clasificar el error dependiendo de la excepción
            // para presentarlo en la respuesta Json
            return -1;
        }
    }

    /**
     * Actualiza un registro de la bases de datos basado
     * en los nuevos valores relacionados con un identificador
     *
     * @param $Menu_Id      identificador
     * @param $Menu_Name      nuevo nombre

     */
    public static function update(
        $Menu_Id,
        $Menu_Name
    )
    {
        // Creando consulta UPDATE
        $consulta = "UPDATE Menu" .
            " SET Menu_Name=? " .
            "WHERE Menu_Id=?";

        // Preparar la sentencia
        $cmd = Database::getInstance()->getDb()->prepare($consulta);

        // Relacionar y ejecutar la sentencia
        $cmd->execute(array($Menu_Name,$Menu_Id));

        return $cmd;
    }

    /**
     * Insertar una nueva Menu
     *
     * @param $Menu_Name      nombre del nuevo registro

     * @return PDOStatement
     */
    public static function insert(
        $Menu_Name
    )
    {
        // Sentencia INSERT
        $comando = "INSERT INTO Menu ( " .
            "Menu_Name)" .
            " VALUES(?)";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(
            array(
                $Menu_Name
            )
        );

    }

    /**
     * Eliminar el registro con el identificador especificado
     *
     * @param $idMenu identificador de la Menu
     * @return bool Respuesta de la eliminación
     */
    public static function delete($Menu_Id)
    {
        // Sentencia DELETE
        $comando = "DELETE FROM Menu WHERE Menu_Id=?";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(array($Menu_Id));
    }
}

?>