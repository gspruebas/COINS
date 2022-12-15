<?php


session_start();

if ($_SESSION['role'] != 1) {
    header('location: ./');
}
include "../conexion.php";


if (!empty($_POST)) {
    $alert = '';
    if (empty($_POST['nombre']) || empty($_POST['dpi']) || empty($_POST['colaborador']) || empty($_POST['clave']) || empty($_POST['rol'])) {
        $alert = '<p class="msg_error"> Todos los campos son obligatorios</p>';
    } else {


        $nombre = $_POST['nombre'];
        $email = $_POST['dpi'];
        $user = $_POST['colaborador'];
        $clave = md5($_POST['clave']);
        $rol = $_POST['rol'];

        $query = mysqli_query($conection, "SELECT * FROM colaborador WHERE colaborador = '$user' OR dpi = '$email' ");
        mysqli_close($conection);
        $result = mysqli_fetch_array($query);

        if ($result > 0) {
            $alert = '<p class="msg_error"> El dpi o el colaborador ya existen</p>';
        } else {
            $query_insert = mysqli_query($conection, "INSERT INTO colaborador(nombre,dpi,colaborador,clave,rol) VALUES ('$nombre', '$email','$user','$clave', '$rol')");

            if ($query_insert) {
                $alert = '<p class="msg_save"> colaborador creado correctamente</p>';
            } else {
                $alert = '<p class="msg_error"> Error en la creacion del colaborador</p>';
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
    <title>Registro de colaborador</title>
</head>

<body>
    <?php include "includes/header.php"; ?>
    <section id="container">
        <div class="form_register">

            <CENTER>
                <h1><i class="fa-solid fa-address-card"></i> Registro Colaborador</h1>
            </CENTER>
            <hr>
            <div class="alert">
                <?php echo isset($alert) ? $alert : ''; ?>
            </div>
            <form actions="" method="post">

                <!-- nombre -->
                <label for="nombre"><i class="fa-solid fa-user"></i>  Nombre</label>
                <input type="text" name="nombre" id="nombre" placeholder="Nombre Completo">

                <!-- dpi -->

                <label for="dpi"><i class="fa-solid fa-credit-card"></i> DPI</label>
                <input type="text" name="dpi" id="dpi" placeholder="dpi ">

                <!-- colaborador -->

                <label for="colaborador"><i class="fa-solid fa-user"></i> colaborador</label>
                <input type="text" name="colaborador" id="colaborador" placeholder="colaborador">

                <!-- Clave -->

                <label for="clave"><i class="fa-solid fa-key"></i> contraseña</label>
                <input type="password" name="clave" id="clave" placeholder="clave de acceso">

                <!-- rol -->

                <label for="rol"><i class="fa-solid fa-user"></i> tipo de colaborador</label>

                <?php


                $query_rol = mysqli_query($conection, "SELECT * FROM rolcolaborador");
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
                    <button type="submit" class="btn_save "><i class="fa-solid fa-floppy-disk"></i> Crear colaborador</button>
                </CENTEr>
            </form>
        </div>
        


    </section>


    <?php include "includes/footer.php"; ?>
</body>


</html>