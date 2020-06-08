<?php
use Clases\Facultad;

include_once "config/autoload.php";
include_once "menu.php";
?>
    <h1>Registrar Facultad</h1>
    <form method="post" action="#">
         <input type="text" name="nombre" placeholder="Nombre Facultad" required/><br>
        <input type="submit" name="submit" value="Guardar">

    </form>

<?php
if (isset($_POST["submit"])) {
    $nombre = $_POST["nombre"];

    $facultad = new Facultad($nombre);
    if ($facultad->CrearFacultad()) {
        echo "Datos guardados";
    } else {
        echo "Error: Los datos no se guardaron";
    }
}
