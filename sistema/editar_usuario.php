<?php

session_start();

if($_SESSION['role'] != 1)
{
    header('location: ./');
}

include "../conexion.php";


if (!empty($_POST)) {
    $alert = '';
    if (empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['usuario']) || empty($_POST['rol'])) {
        $alert = '<p class="msg_error"> Todos los campos son obligatorios</p>';
    } else {

        $idUsuario = $_POST['idUsuario'];
        $nombre = $_POST['nombre'];
        $email = $_POST['correo'];
        $user = $_POST['usuario'];
        $clave = md5($_POST['clave']);
        $rol = $_POST['rol'];



        $query = mysqli_query($conection, "SELECT * FROM usuario 
        where(usuario = '$user' and idusuario != $idUsuario)
          OR (correo = '$email' and idusuario != $idUsuario)");



        $result = mysqli_fetch_array($query);

        if ($result > 0) {
            $alert = '<p class="msg_error"> El correo o el usuario ya existen</p>';
        } else {

            if (empty($_POST['clave'])) {
                $sql_update = mysqli_query($conection, "UPDATE usuario
                SET nombre = '$nombre', correo = '$email', usuario='$user', rol = '$rol'
                WHERE idusuario = '$idUsuario'");
            } else {
                $sql_update = mysqli_query($conection, "UPDATE usuario
                                                SET nombre = '$nombre', correo = '$email', usuario='$user', clave='$clave', rol = '$rol'
                                                where idusuario = '$idUsuario");
            }

            if ($sql_update) {
                $alert = '<p class="msg_save"> Usuario actualizado correctamente</p>';
            } else {
                $alert = '<p class="msg_error"> Error en la actualizaciòn del Usuario</p>';
            }
        }
    }

    mysqli_close($conection);
}

//mostrar datos 
if (empty($_GET['id'])) {
    header('Location: lista_usuario.php');
    mysqli_close($conection);
}
$iduser = $_GET['id'];
include "../conexion.php";
$sql = mysqli_query($conection, "SELECT u.idusuario, u.nombre, u.correo, u.usuario, (u.rol) as idrol, (r.rol) as rol 
FROM usuario u 
INNER JOIN rol r 
on u.rol = r.idrol 
WHERE idusuario= $iduser");
mysqli_close($conection);
$result_sql = mysqli_num_rows($sql);
if ($result_sql == 0) {
    header('Location: lista_usuario.php');
} else {

    $option = '';

    while ($data = mysqli_fetch_array($sql)) {
        $iduser = $data['idusuario'];
        $nombre = $data['nombre'];
        $correo = $data['correo'];
        $usario = $data['usuario'];
        $idrol = $data['idrol'];
        $rol = $data['rol'];

        if ($idrol == 1) {
            $option = ' <option value="' . $idrol . '" select>' . $rol . '</option>';
        } elseif ($idrol == 2) {
            $option = ' <option value="' . $idrol . '" select>' . $rol . '</option>';
        } elseif ($idrol == 3) {
            $option = ' <option value="' . $idrol . ' select">' . $rol . '</option>';
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
    <title>Actualizar Usuario</title>
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

            <h1>Actualiza Usuario</h1>
            <hr>
            <div class="alert">
                <?php echo isset($alert) ? $alert : ''; ?>
            </div>
            <form actions="" method="post">

                <input type="hidden" name="idUsuario" value="<?php echo $iduser; ?>">


                <!-- nombre -->
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" placeholder="Nombre Completo" value="<?php echo $nombre; ?>">

                <!-- correo -->

                <label for="correo">correo electronico</label>
                <input type="email" name="correo" id="correo" placeholder="Correo electronico" value="<?php echo $correo; ?>">

                <!-- Usuario -->

                <label for="usuario">Usuario</label>
                <input type="text" name="usuario" id="usuario" placeholder="Usuario" value="<?php echo $usario; ?>">

                <!-- Clave -->

                <label for="clave">contraseña</label>
                <input type="password" name="clave" id="clave" placeholder="clave de acceso">

                <!-- rol -->

                <label for="rol">tipo de Usuario</label>

                <?php

                include "../conexion.php";
                $query_rol = mysqli_query($conection, "SELECT * FROM rol");
                mysqli_close($conection);
                $result_rol = mysqli_num_rows($query_rol);
                ?>
                <select name="rol" id="rol" class="notItemOne">
                    <?php
                    echo $option;
                    if ($result_rol > 0) {

                        while ($rol = mysqli_fetch_array($query_rol)) {


                    ?>
                            <option value="<?php echo $rol["idrol"]; ?>">
                                <?php echo $rol["rol"] ?>
                            </option>
                    <?php


                        }
                    }


                    ?>


                </select>

                <input type="submit" value="Actualizar Usuario" class="btn_save">
            </form>
        </div>



    </section>


    <?php include "includes/footer.php"; ?>
</body>


</html>