<?php
namespace Clases;
use Clases\ConexionDB as db;

require_once "config/autoload.php";

class Estudiante extends Usuario
{
    private $codigo;

    public function __construct($codigo, $nombres, $apellidos, $telefono, $correo, $id_pa)
    {
        parent::__construct($nombres, $apellidos, $telefono, $correo, $id_pa);
        $this->codigo = $codigo;
    }

    public function getCodigo()
    {
        return $this->codigo;
    }

    public function setCodigo($codigo): void
    {
        $this->codigo = $codigo;
    }

    public function crearEstudiante() : bool {
        try {
            $db = new db();
            $conn = $db->abrirConexion();

            $sql = "INSERT INTO estudiantes(codigo, nombres, apellidos, telefono, correo, id_pa) 
                    VALUES('$this->codigo','$this->nombres', '$this->apellidos', '$this->telefono', '$this->correo', $this->id_pa)";
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

function mostrarEstudiante(){
    try{
        $db = new db();
        $conn = $db->abrirConexion();

        $sql="SELECT  e.id, e.nombres, e.apellidos, pa.nombre FROM estudiantes as e join pa on e.id_pa=pa.id";
        $respuesta = $conn->prepare($sql);
        $respuesta-> execute();
        while($fila=$respuesta->fetch(PDO::FETCH_ASSOC) ){
            echo "<table border=1>";
            echo "<tr>";
            echo "<td width=70px>"; 
            echo $fila["nombres"];
            echo "</td>";
            echo "<td width=70px>"; 
            echo $fila["apellidos"];
            echo "</td>";
            echo "<td width=150px>"; 
            echo $fila["nombre"];
            echo "</td>";
            echo "<td width=70px>"; 
            echo "<html>";
            echo '<a href="actualizar.php?id='.$fila["id"].'"; ?>Actualizar</a>';
            echo "</html>";
            echo "</td>";
            echo "<td width=70px>"; 
            echo "<html>";
            echo '<a href="borrar.php?id='.$fila["id"].'"; ?>Borrar</a>';
            echo "</html>";
            echo "</td>";
            echo "</tr>";
            echo "</table>";
        }
        $db->cerrarConexion();
        return $fila;
    }
    catch(PDOexception $e){
        echo $e->getMessage();
    }
}
