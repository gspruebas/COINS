<?php

session_start();
if ($_SESSION['role'] != 1) {
    header('location: ./');
}

include "../conexion.php";


if (!empty($_POST)) {
    $alert = '';
    if (empty($_POST['proyecto'])  || empty($_POST['cliente'])) {
        $alert = '<p class="msg_error"> Todos los campos son obligatorios</p>';
    } else {

        $codproyecto = $_POST['codproyecto'];
        $proyecto = $_POST['proyecto'];
        $cliente = $_POST['cliente'];






        $sql_update = mysqli_query($conection, "UPDATE proyecto
                                                SET proyecto = '$proyecto', cliente = '$cliente'
                                                where codproyecto = $codproyecto");


        if ($sql_update) {
            $alert = '<p class="msg_save"> proyecto actualizado correctamente</p>';
        } else {
            $alert = '<p class="msg_error"> Error en la actualizaciòn del proyecto</p>';
        }
    }
}

//mostrar datos 
if (empty($_GET['id'])) {
    header('Location: lista_proyectos.php');
    mysqli_close($conection);
}
$idproyecto = $_GET['id'];
include "../conexion.php";
$sql = mysqli_query($conection, "SELECT * FROM proyecto 
WHERE codproyecto= $idproyecto");
mysqli_close($conection);
$result_sql = mysqli_num_rows($sql);
if ($result_sql == 0) {
    header('Location: lista_proyectos.php');
} else {

    $option = '';

    while ($data = mysqli_fetch_array($sql)) {
        $idproyecto = $data['codproyecto'];
        $proyecto = $data['proyecto'];
        $cliente = $data['cliente'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, iclienteial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <?php include "includes/scripts.php"; ?>
    <title>Actualizar proyecto</title>
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

            <h1>Actualiza proyecto</h1>
            <hr>
            <div class="alert">
                <?php echo isset($alert) ? $alert : ''; ?>
            </div>
            <form actions="" method="post">

                <input type="hidden" name="codproyecto" value="<?php echo $idproyecto; ?>">


                <!-- proyecto -->
                <label for="proyecto">proyecto</label>
                <input type="text" name="proyecto" id="proyecto" placeholder="proyecto" value="<?php echo $proyecto; ?>">

                
                <!-- cliente -->
                <label for="cliente"><i class="fa-solid fa-user"></i> cliente</label>

                <!-- poner lista despegable -->
                <?php
                include "../conexion.php";
                $query_cliente = mysqli_query($conection, "SELECT nombre FROM cliente");
                $result_cliente = mysqli_num_rows($query_cliente);


                ?>
                <select name="cliente" id="cliente" value="<?php echo $cliente; ?>">
                    <?php

                    if ($result_cliente > 0) {
                        while ($cliente = mysqli_fetch_array($query_cliente)) {



                    ?>

                            <option value="<?php echo $cliente['nombre']; ?>"><?php echo $cliente['nombre'] ?></option>


                    <?php

                        }
                    }
                    ?>

                </select>

                <input type="submit" value="Actualizar proyecto" class="btn_save">
            </form>
        </div>



    </section>


    <?php include "includes/footer.php"; ?>
</body>


</html>