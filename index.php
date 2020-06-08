<?php
include_once "Clases/Estudiante.php";
include_once "menu.php";
include_once "config/autoload.php";
use Clases\ConexionDB as db;
?>
<table border="1">
    <tr>
        <th>Nombres</th>
        <th>Apellidos</th>
        <th>Programa</th>
        <th colspan="2">&nbsp;</th>
    </tr>
    <!-- TODO: cargar datos de los estudiantes -->
    <tr>
        <?php
        function mostrarEstudiante(){
            try{
                $db = new db();
                $conn = $db->abrirConexion();
        
                $sql="SELECT  e.id, e.nombres, e.apellidos, pa.nombre FROM estudiantes as e join pa on e.id_pa=pa.id";
                $respuesta = $conn->prepare($sql);
                $respuesta-> execute();
                while($fila=$respuesta->fetch(PDO::FETCH_ASSOC) ){
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
                    echo '<a href="clases/borrarEstudiante.php?id='.$fila["id"].'"; ?>Borrar</a>';
                    echo "</html>";
                    echo "</td>";
                    echo "</tr>";
                }
                $db->cerrarConexion();
                return $fila;
            }
            catch(PDOexception $e){
                echo $e->getMessage();
            }
        }
        mostrarEstudiante();
        ?>
    </tr>
</table>