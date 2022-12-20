<?php

session_start();
if ($_SESSION['role'] != 1) {
    header('location: ./');
}

include "../conexion.php";


if (!empty($_POST)) {
    $alert = '';
    if (empty($_POST['proveedor']) || empty($_POST['direccion']) || empty($_POST['contacto'])  || empty($_POST['telefono'])) {
        $alert = '<p class="msg_error"> Todos los campos son obligatorios</p>';
    } else {

        $codproveedor = $_POST['codproveedor'];
        $proveedor = $_POST['proveedor'];
        $contacto = $_POST['contacto'];
        $direccion = $_POST['direccion'];
        $telefono = $_POST['telefono'];





        $sql_update = mysqli_query($conection, "UPDATE proveedor
                                                SET proveedor = '$proveedor', contacto = '$contacto', direccion='$direccion', telefono = '$telefono'
                                                where codproveedor = $codproveedor");


        if ($sql_update) {
            $alert = '<p class="msg_save"> proveedor actualizado correctamente</p>';
        } else {
            $alert = '<p class="msg_error"> Error en la actualizaciòn del proveedor</p>';
        }
    }
}

//mostrar datos 
if (empty($_GET['id'])) {
    header('Location: lista_proveedors.php');
    mysqli_close($conection);
}
$idproveedor = $_GET['id'];
include "../conexion.php";
$sql = mysqli_query($conection, "SELECT * FROM proveedor 
WHERE codproveedor= $idproveedor");
mysqli_close($conection);
$result_sql = mysqli_num_rows($sql);
if ($result_sql == 0) {
    header('Location: lista_proveedor.php');
} else {

    $option = '';

    while ($data = mysqli_fetch_array($sql)) {
        $idproveedor = $data['codproveedor'];
        $proveedor = $data['proveedor'];
        $contacto = $data['contacto'];
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
    <meta name="viewport" content="width=device-width, icontactoial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <?php include "includes/scripts.php"; ?>
    <title>Actualizar proveedor</title>
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

            <h1>Actualiza proveedor</h1>
            <hr>
            <div class="alert">
                <?php echo isset($alert) ? $alert : ''; ?>
            </div>
            <form actions="" method="post">

                <input type="hidden" name="codproveedor" value="<?php echo $idproveedor; ?>">


                <!-- proveedor -->
                <label for="proveedor">proveedor</label>
                <input type="text" name="proveedor" id="proveedor" placeholder="proveedor" value="<?php echo $proveedor; ?>">

                <!-- contacto -->

                <label for="contacto">Contacto</label>
                <input type="contacto" name="contacto" id="contacto" placeholder="Contacto" value="<?php echo $contacto; ?>">


                <!-- direccion -->

                <label for="direccion">Dirección</label>
                <input type="text" name="direccion" id="direccion" placeholder="Direccion" value="<?php echo $direccion; ?>">

                <!-- telefono -->

                <label for="direccion">Telefono</label>
                <input type="number" name="telefono" id="telefono" placeholder="Telefono" value="<?php echo $telefono; ?>">


                </select>

                <input type="submit" value="Actualizar proveedor" class="btn_save">
            </form>
        </div>



    </section>


    <?php include "includes/footer.php"; ?>
</body>


</html>