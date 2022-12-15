<?php

session_start();
include "../conexion.php";


if (!empty($_POST)) {
    $alert = '';
    if (empty($_POST['nombre']) || empty($_POST['dpi'])  || empty($_POST['telefono'])) {
        $alert = '<p class="msg_error"> Todos los campos son obligatorios</p>';
    } else {

        $idcliente = $_POST['idcliente'];
        $nombre = $_POST['nombre'];
        $dpi = $_POST['dpi'];
        $direccion = $_POST['direccion'];
        $telefono = $_POST['telefono'];



        $query = mysqli_query($conection, "SELECT * FROM cliente 
        where(nombre = '$nombre' and idcliente != $idcliente)
          OR (dpi = '$dpi' and idcliente != $idcliente)");



        $result = mysqli_fetch_array($query);

        if ($result > 0) {
            $alert = '<p class="msg_error"> El dpi o el cliente ya existen</p>';
        } else {

            if (empty($_POST['direccion'])) {
                $sql_update = mysqli_query($conection, "UPDATE cliente
                SET nombre = '$nombre', dpi = '$dpi', telefono = '$telefono'
                WHERE idcliente = '$idcliente'");
            } else {
                $sql_update = mysqli_query($conection, "UPDATE cliente
                                                SET nombre = '$nombre', dpi = '$dpi', direccion='$direccion', telefono = '$telefono'
                                                where idcliente = $idcliente");
            }

            if ($sql_update) {
                $alert = '<p class="msg_save"> cliente actualizado correctamente</p>';
            } else {
                $alert = '<p class="msg_error"> Error en la actualizaciòn del cliente</p>';
            }
        }
    }

    mysqli_close($conection);
}

//mostrar datos 
if (empty($_GET['id'])) {
    header('Location: lista_clientes.php');
    mysqli_close($conection);
}
$iduser = $_GET['id'];
include "../conexion.php";
$sql = mysqli_query($conection, "SELECT * FROM cliente 
WHERE idcliente= $iduser");
mysqli_close($conection);
$result_sql = mysqli_num_rows($sql);
if ($result_sql == 0) {
    header('Location: lista_cliente.php');
} else {

    $option = '';

    while ($data = mysqli_fetch_array($sql)) {
        $iduser = $data['idcliente'];
        $nombre = $data['nombre'];
        $dpi = $data['DPI'];
        $direccion = $data['direccion'];
        $telefono = $data['telefono'];

    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <?php include "includes/scripts.php"; ?>
    <title>Actualizar cliente</title>
</head>
<style>
    .notItemOne option:first-child {
        display: none;
    }
</style>

<body>
    <?php include "includes/header.php"; ?>
    <section id="container">
        <div class="form_register">

            <h1>Actualiza cliente</h1>
            <hr>
            <div class="alert">
                <?php echo isset($alert) ? $alert : ''; ?>
            </div>
            <form actions="" method="post">

                <input type="hidden" name="idcliente" value="<?php echo $iduser; ?>">


                <!-- nombre -->
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" placeholder="Nombre Completo" value="<?php echo $nombre; ?>">

                <!-- dpi -->

                <label for="dpi">NIT</label>
                <input type="dpi" name="dpi" id="dpi" placeholder="dpi" value="<?php echo $dpi; ?>">

            
                <!-- direccion -->

                <label for="direccion">Direccion</label>
                <input type="text" name="direccion" id="direccion" placeholder="Direccion" value="<?php echo $direccion; ?>">

                <!-- telefono -->

                <label for="direccion">Telefono</label>
                <input type="number" name="telefono" id="telefono" placeholder="Telefono" value="<?php echo $telefono; ?>">
                

                </select>

                <input type="submit" value="Actualizar cliente" class="btn_save">
            </form>
        </div>



    </section>


    <?php include "includes/footer.php"; ?>
</body>


</html>