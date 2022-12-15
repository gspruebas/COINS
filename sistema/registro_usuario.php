<?php
session_start();

if ($_SESSION['role'] != 1) {
    header('location: ./');
}



include "../conexion.php";


if (!empty($_POST)) {
    $alert = '';
    if (empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['usuario']) || empty($_POST['clave']) || empty($_POST['rol'])) {
        $alert = '<p class="msg_error"> Todos los campos son obligatorios</p>';
    } else {


        $nombre = $_POST['nombre'];
        $email = $_POST['correo'];
        $user = $_POST['usuario'];
        $clave = md5($_POST['clave']);
        $rol = $_POST['rol'];

        $query = mysqli_query($conection, "SELECT * FROM usuario WHERE usuario = '$user' OR correo = '$email' ");
        mysqli_close($conection);
        $result = mysqli_fetch_array($query);
        include "../conexion.php";

        if ($result > 0) {
            $alert = '<p class="msg_error"> El correo o el usuario ya existen</p>';
        } else {
            $query_insert = mysqli_query($conection, "INSERT INTO usuario(nombre,correo,usuario,clave,rol) VALUES ('$nombre', '$email','$user','$clave', '$rol')");

            if ($query_insert) {
                $alert = '<p class="msg_save"> Usuario creado correctamente</p>';
            } else {
                $alert = '<p class="msg_error"> Error en la creacion del Usuario</p>';
            }
        }
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
    <title>Registro de Usuario</title>
</head>

<body>
    <?php include "includes/header.php"; ?>
    <section id="container">
        <div class="form_register">

            <CENTER>
                <h1><i class="fa-solid fa-address-card"></i> Registro Usuario</h1>
            </CENTER>
            <hr>
            <div class="alert">
                <?php echo isset($alert) ? $alert : ''; ?>
            </div>
            <form actions="" method="post">

                <!-- nombre -->
                <label for="nombre"><i class="fa-solid fa-user"></i>  Nombre</label>
                <input type="text" name="nombre" id="nombre" placeholder="Nombre Completo">

                <!-- correo -->

                <label for="correo"><i class="fa-solid fa-envelope"></i> correo electronico</label>
                <input type="email" name="correo" id="correo" placeholder="Correo electronico">

                <!-- Usuario -->

                <label for="usuario"><i class="fa-solid fa-user"></i> Usuario</label>
                <input type="text" name="usuario" id="usuario" placeholder="Usuario">

                <!-- Clave -->

                <label for="clave"><i class="fa-solid fa-key"></i> contraseña</label>
                <input type="password" name="clave" id="clave" placeholder="clave de acceso">

                <!-- rol -->

                <label for="rol"><i class="fa-solid fa-users-viewfinder"></i> tipo de Usuario</label>

                <?php

                include "../conexion.php";
                $query_rol = mysqli_query($conection, "SELECT * FROM rol");
                mysqli_close($conection);
                $result_rol = mysqli_num_rows($query_rol);





                ?>


                <select name="rol" id="rol">


                    <?php

                    if ($result_rol > 0) {

                        while ($rol = mysqli_fetch_array($query_rol)) {


                    ?>
                            <option value="<?php echo $rol["idrol"]; ?>"><?php echo $rol["rol"] ?></option>
                    <?php


                        }
                    }


                    ?>


                </select>

                <CENTEr>
                    <button type="submit" class="btn_save "><i class="fa-solid fa-floppy-disk"></i> Crear Usuario</button>
                </CENTEr>
            </form>
        </div>



    </section>


    <?php include "includes/footer.php"; ?>
</body>


</html>