<?php

session_start();

if($_SESSION['role'] != 1)
{
    header('location: ./');
}

include "../conexion.php";

if (!empty($_POST)) {


    $codproveedor = $_POST['codproveedor'];
    $query_delete = mysqli_query($conection, "DELETE FROM proveedor where codproveedor = $codproveedor");
    mysqli_close($conection);
    if ($query_delete) {
        header('Location: lista_proveedores.php');
    } else {
        echo "Error al eliminar";
    }
}



$codproveedor = $_REQUEST['id'];

$query = mysqli_query($conection, "SELECT * FROM proveedor where codproveedor = $codproveedor");


mysqli_close($conection);

$result = mysqli_num_rows($query);
if ($result > 0) {
    while ($data = mysqli_fetch_array($query)) {
        $proveedor = $data['proveedor'];
        $contacto = $data['contacto'];
        $telefono = $data['telefono'];
        $direccion = $data['direccion'];
    }
} else {
    header('Location: lista_proveedores.php');
}



?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <?php include "includes/scripts.php" ?>
    <title>Eliminar Proveedor</title>
</head>
<style>
    .data_delete {
        text-align: center;
    }

    .data_delete h2 {
        font-size: 12pt;

    }

    .data_delete span {
        font-weight: bold;
        color: #4f72d4;
        font-size: 12pt;
    }
</style>


<body>
    <?php include "includes/header.php" ?>
    <section id="container">
        <div class="data_delete">
            <h2>¿esta seguro de eliminar el siguiente registro?</h2>
            <p>proveedor: <span>
                    <?php echo $proveedor; ?>
                </span></p>
            <p>telefono: <span>
                    <?php echo $telefono; ?>
                </span></p>
            <p>Dirección: <span>
                    <?php echo $direccion; ?>
                </span></p>


            <form method="post" action="">
                <input type="hidden" name="codproveedor" value="<?php echo $codproveedor; ?>">
                <a href="lista_proveedores.php" class="btn btn-danger">Cancelar</a>
                <input type="submit" value="Aceptar" class="btn btn-warning">
            </form>
        </div>


    </section>


    <?php include "includes/footer.php" ?>
</body>

</html>