<?php
namespace Clases;
use Clases\ConexionDB as db;

require_once "config/autoload.php";

class Programa
{
    private $nombre;
    private $id_facultad;

    public function __construct($nombre)
    {
        $this->nombre = $nombre;
    }

    public function getNombre():string
    {
        return $this->nombre;
    }

    public function setNombre($nombre): void
    {
        $this->nombre = $nombre;
    }

    public function getIdFacultad():int
    {
        return $this->id_facultad;
    }

    public function setIdFacultad($id_facultad): void
    {
        $this->id_facultad = $id_facultad;
    }

    public function CrearPrograma() {
        try {
            $db = new db();
            $conn = $db->abrirConexion();

            $sql = "INSERT INTO pa(nombre) VALUES ('$this->nombre')";
            $respuesta = $conn->prepare($sql);
            $respuesta->execute();
            $numRows = $respuesta->rowCount();
            if($numRows!=0){
                $result = true;
            }else{
                $result = false;
            }

            $db->cerrarConexion();

            return $result;
        }
        catch (PDOException $e){
            echo $e->getMessage();
        }
    }
}