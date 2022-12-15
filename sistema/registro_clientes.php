<?php

session_start();

include "../conexion.php";


if (!empty($_POST)) {

    $alert = '';
    if (empty($_POST['nombre']) || empty($_POST['telefono']) || empty($_POST['direccion'])) {
        $alert = '<p class="msg_error"> Todos los campos son obligatorios</p>';
    } else {

        $dpi        = $_POST['dpi'];
        $nombre     = $_POST['nombre'];
        $telefono   = $_POST['telefono'];
        $direccion  = $_POST['direccion'];
        $usuario_id = $_SESSION['idUser'];


        $result = 0;
        if (is_numeric($dpi) and $dpi !=0) {
            $query = mysqli_query($conection, "SELECT * FROM cliente WHERE dpi = '$dpi' ");
            $result = mysqli_fetch_array($query);
        }

        if ($result > 0) {

            $alert = '<p class="msg_error"> El número de NIT ya esta Registrado</p>';
        } else {
            $query_insert = mysqli_query($conection, "INSERT INTO cliente(DPI,nombre,telefono,direccion,usuario_id) 
                                                    VALUES ('$dpi','$nombre','$telefono','$direccion','$usuario_id')");

            if ($query_insert) {
                $alert = '<p class="msg_save"> cliente creado correctamente</p>';
            } else {
                $alert = '<p class="msg_error"> Error en la creacion del cliente</p>';
            }
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <?php include "includes/scripts.php"; ?>
    <title>Registro Cliente</title>
</head>

<body>
    <?php include "includes/header.php"; ?>
    <section id="container">
        <div class="form_register">
            <CENTER>
            <h1><i class="fa-solid fa-address-card"></i> Registro Cliente</h1>
            </CENTER>
            <hr>
            <div class="alert">
                <?php echo isset($alert) ? $alert : ''; ?>
            </div>
            <form action="" method="post">

                <!-- dpi -->

                <label for="dpi"><i class="fa-solid fa-credit-card-front"></i> NIT</label>
                <input type="number" name="dpi" id="dpi" placeholder="NIT">


                <!-- nombre -->
                <label for="nombre"><i class="fa-solid fa-user"></i>  Nombre</label>
                <input type="text" name="nombre" id="nombre" placeholder="Nombre Completo">


                <!-- nombre -->
                <label for="telefono"><i class="fa-solid fa-phone"></i> Telefono</label>
                <input type="number" name="telefono" id="telefono" placeholder="Telefono">


                <!-- direccion -->

                <label for="direccion"><i class="fa-solid fa-house-chimney-user"></i>  Direccion</label>
                <input type="text" name="direccion" id="direccion" placeholder="Direccion">


                <CENTEr>
                    <button type="submit" class="btn_save "><i class="fa-solid fa-floppy-disk"></i> Crear Cliente</button>
                </CENTEr>
            </form>
        </div>



    </section>


    <?php include "includes/footer.php"; ?>
</body>


</html>