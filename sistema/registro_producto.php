<?php

session_start();

if ($_SESSION['role'] != 1) {
    header('location: ./');
}

include "../conexion.php";


if (!empty($_POST)) {

    $alert = '';
    if (empty($_POST['Proveedor']) || empty($_POST['contacto']) || empty($_POST['telefono']) || empty($_POST['direccion'])) {
        $alert = '<p class="msg_error"> Todos los campos son obligatorios</p>';
    } else {

        $Proveedor  = $_POST['Proveedor'];
        $contacto     = $_POST['contacto'];
        $telefono   = $_POST['telefono'];
        $direccion  = $_POST['direccion'];
        $usuario_id = $_SESSION['idUser'];


            $query_insert = mysqli_query($conection, "INSERT INTO proveedor(Proveedor,contacto,telefono,direccion,usuario_id) 
                                                    VALUES ('$Proveedor','$contacto','$telefono','$direccion','$usuario_id')");

            if ($query_insert) {
                $alert = '<p class="msg_save"> proveedor creado correctamente</p>';
            } else {
                $alert = '<p class="msg_error"> Error en la creacion del proveedor</p>';
            }
        }
   
        mysqli_close($conection);
    }
    


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, iProveedorial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <?php include "includes/scripts.php"; ?>
    <title>Registro Proveedor</title>
</head>

<body>
    <?php include "includes/header.php"; ?>
    <section id="container">
        <div class="form_register">
            <CENTER>
            <h1><i class="fa-solid fa-address-card"></i> Registro Proveedor</h1>
            </CENTER>
            <hr>
            <div class="alert">
                <?php echo isset($alert) ? $alert : ''; ?>
            </div>
            <form action="" method="post">

                <!-- Proveedor -->

                <label for="Proveedor"><i class="fa-solid fa-credit-card-front"></i> Proveedor</label>
                <input type="text" name="Proveedor" id="Proveedor" placeholder="contacto del Proveedor">


                <!-- contacto -->
                <label for="contacto"><i class="fa-solid fa-user"></i>  Contacto</label>
                <input type="text" name="contacto" id="contacto" placeholder="contacto Completo del Contacto">


                <!-- contacto -->
                <label for="telefono"><i class="fa-solid fa-phone"></i> Telefono</label>
                <input type="number" name="telefono" id="telefono" placeholder="Telefono">


                <!-- direccion -->

                <label for="direccion"><i class="fa-solid fa-house-chimney-user"></i>  Direccion</label>
                <input type="text" name="direccion" id="direccion" placeholder="Direccion">


                <CENTEr>
                    <button type="submit" class="btn_save "><i class="fa-solid fa-floppy-disk"></i> Crear proveedor</button>
                </CENTEr>
            </form>
        </div>



    </section>


    <?php include "includes/footer.php"; ?>
</body>


</html>