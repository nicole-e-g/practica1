<?php
use Clases\Programa;

include_once "config/autoload.php";
include_once "menu.php";
?>
    <h1>Registrar Programa</h1>
    <form method="post" action="#">
         <input type="text" name="nombre" placeholder="Nombre Programa" required/><br>
        <input type="submit" name="submit" value="Guardar">

    </form>

<?php
if (isset($_POST["submit"])) {
    $nombre = $_POST["nombre"];

    $programas = new Programa($nombre);
    if ($programas->CrearPrograma()) {
        echo "Datos guardados";
    } else {
        echo "Error: Los datos no se guardaron";
    }
}