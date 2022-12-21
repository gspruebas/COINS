<?php

session_start();

if ($_SESSION['role'] != 1) {
    header('location: ./');
}

include "../conexion.php";


if (!empty($_POST)) {

    $alert = '';
    if (empty($_POST['proyecto']) || empty($_POST['cliente'])) {
        $alert = '<p class="msg_error"> Todos los campos son obligatorios</p>';
    } else {

        $proyecto  = $_POST['proyecto'];
        $cliente     = $_POST['cliente'];
        $id_usuario = $_SESSION['idUser'];


        $query_insert = mysqli_query($conection, "INSERT INTO proyecto(proyecto,cliente,id_usuario) 
                                                    VALUES ('$proyecto','$cliente','$id_usuario')");

        if ($query_insert) {
            $alert = '<p class="msg_save"> proyecto creado correctamente</p>';
        } else {
            $alert = '<p class="msg_error"> Error en la creacion del proyecto</p>';
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
    <meta name="viewport" content="width=device-width, iproyectoial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <?php include "includes/scripts.php"; ?>
    <title>Registro proyecto</title>
</head>

<body>
    <?php include "includes/header.php"; ?>
    <section id="container">
        <div class="form_register">
            <CENTER>
                <h1><i class="fa-solid fa-address-card"></i> Registro proyecto</h1>
            </CENTER>
            <hr>
            <div class="alert">
                <?php echo isset($alert) ? $alert : ''; ?>
            </div>
            <form action="" method="post">

                <!-- proyecto -->

                <label for="proyecto"><i class="fa-solid fa-user"></i> proyecto</label>
                <input type="text" name="proyecto" id="proyecto" placeholder="cliente del proyecto">


                <!-- cliente -->
                <label for="cliente"><i class="fa-solid fa-user"></i> cliente</label>

                <!-- poner lista despegable -->
                <?php
                include "../conexion.php";
                $query_cliente = mysqli_query($conection, "SELECT nombre FROM cliente");
                $result_cliente = mysqli_num_rows($query_cliente);
                

                ?>
                <select name="cliente" id="cliente">
                    <?php

                    if ($result_cliente > 0) {
                        while ($cliente = mysqli_fetch_array($query_cliente)) {



                    ?>

                            <option value="<?php echo $cliente['nombre']; ?>"><?php echo $cliente['nombre']?></option>


                    <?php

                        }
                    }
                    ?>
                </select>






                <CENTEr>
                    <button type="submit" class="btn_save "><i class="fa-solid fa-floppy-disk"></i> Crear proyecto</button>
                </CENTEr>
            </form>
        </div>



    </section>


    <?php include "includes/footer.php"; ?>
</body>


</html>