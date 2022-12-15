<?php
session_start();

if($_SESSION['role'] != 1)
{
    header('location: ./');
}


include "../conexion.php";

if (!empty($_POST)) {

    if ($_POST['idcolaborador'] == 1) {
        header("location: lista_colaborador.php");
        mysqli_close($conection);
        exit;
    }
    $idcolaborador = $_POST['idcolaborador'];
    $query_delete = mysqli_query($conection, "DELETE FROM colaborador where idcolaborador = $idcolaborador");
    mysqli_close($conection);
    if ($query_delete) {
        header('Location: lista_colaborador.php');
    } else {
        echo "Error al eliminar";
    }
}

if (empty($_REQUEST['id']) || $_REQUEST['id'] == 1) {
    header('Location: lista_colaborador.php');
    mysqli_close($conection);
} else {


    $idcolaborador = $_REQUEST['id'];

    $query = mysqli_query($conection, "SELECT u.nombre, u.colaborador, r.rol
                                            FROM colaborador u
                                            inner join 
                                            rolcolaborador r
                                            on u.rol = r.idrol
                                            where u.idcolaborador = $idcolaborador");


    mysqli_close($conection);
    $result = mysqli_num_rows($query);
    if ($result > 0) {
        while ($data = mysqli_fetch_array($query)) {
            $nombre = $data['nombre'];
            $colaborador = $data['colaborador'];
            $rol = $data['rol'];
        }
    } else {
        header('Location: lista_colaborador.php');
    }
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
    <title>Eliminar colaborador</title>
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
            <p>Nombre: <span>
                    <?php echo $nombre; ?>
                </span></p>
            <p>colaborador: <span>
                    <?php echo $colaborador; ?>
                </span></p>
            <p>Tipo colaborador: <span>
                    <?php echo $rol; ?>
                </span></p>


            <form method="post" action="">
                <input type="hidden" name="idcolaborador" value="<?php echo $idcolaborador; ?>">
                <a href="lista_colaborador.php" class="btn btn-danger">Cancelar</a>
                <input type="submit" value="Aceptar" class="btn btn-warning">
            </form>
        </div>


    </section>


    <?php include "includes/footer.php" ?>
</body>

</html>