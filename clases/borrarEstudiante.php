<?php
namespace Clases;
use Clases\ConexionDB as db;

require_once "config/autoload.php";

function borrarEstudiante(){
    $id=$_GET["id"];
    $db = new db();
    $conn = $db->abrirConexion();

    try{
        $conn = new PDO($dsn,$usuario, $pass);
        $sql = "DELETE FROM estudiantes WHERE id='$id'";
        $respuesta=$conn->prepare($sql);
        $respuesta->execute();
        $numRows = $respuesta->rowCount();
        if($numRows!=0){
            echo "Se ha borrado";
        }
        else{
            echo "Hubo un error";
        }
        $db->cerrarConexion();
    } 
    catch(PDOException $e) {
        echo $e->getMessage();
    }
}
borrarEstudiante();