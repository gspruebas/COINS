<?php
session_start();

if($_SESSION['role'] != 1)
{
    header('location: ./');
}


include "../conexion.php";


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include "includes/scripts.php" ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Usuarios</title>
</head>
<style>
    /* 
=========usuario============ */


    #container h1 {
        font-size: 35px;
        display: inline-block;
        margin: 25px;
    }

    table {
        border-collapse: collapse;
        font-size: 12pt;
        font-family: Arial, Helvetica, sans-serif;
        width: 100%;
    }


    table td {
        padding: 10px;
    }

    .pageSelected {
        color: #fff;
        background: #428bca;
        border: 15px solid #428bca;
    }
</style>





<body>
    <?php include "includes/header.php" ?>
    <section id="container">
        <h1 class="display-1">Usuarios</h1>
        <a href="registro_usuario.php" type="button" class="btn btn-info">Crear Usuarios</a>

        <nav class="navbar navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand">Gustavo</a>
                <form class="d-flex" action="buscar_usuario.php" method="GET">
                    <input class="form-control me-2" type="text" name="busqueda" id="busqueda" placeholder="buscar">
                    <button class="btn btn-outline-success" type="submit">BUSCAR</button>
                </form>
            </div>
        </nav>

        <table class="table table-striped">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Usuario</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>

            <?php
            $sql_registe = mysqli_query($conection, "SELECT COUNT(*) as total_registro from usuario");
            $result_registe = mysqli_fetch_array($sql_registe);
            $total_registro = $result_registe['total_registro'];


            $por_pagina = 5;

            if (empty($_GET['pagina'])) {
                $pagina = 1;
            } else {
                $pagina = $_GET['pagina'];
            }


            $desde = ($pagina - 1) * $por_pagina;
            $total_pagina = ceil($total_registro / $por_pagina);


            $query = mysqli_query($conection, "SELECT u.idusuario, u.nombre, u.correo, u.usuario, r.rol FROM usuario u INNER JOIN rol r ON u.rol = r.idrol 
            ORDER BY u.idusuario ASC         
            limit $desde, $por_pagina");

            mysqli_close($conection);

            $result = mysqli_num_rows($query);

            if ($result > 0) {
                while ($data = mysqli_fetch_array($query)) {


            ?>

                    <tr>
                        <td>
                            <?php echo $data["idusuario"] ?>
                        </td>
                        <td>
                            <?php echo $data["nombre"] ?>
                        </td>
                        <td>
                            <?php echo $data["correo"] ?>
                        </td>
                        <td>
                            <?php echo $data["usuario"] ?>
                        </td>
                        <td>
                            <?php echo $data["rol"] ?>
                        </td>


                        <td>
                            <a type="button" class="btn btn-success btn-sm col-xs-2 " href="editar_usuario.php?id=<?php echo $data["idusuario"] ?>" me-md-2>Editar</a>

                            <?php

                            if ($data["idusuario"] != 1) {



                            ?>

                                <a type="button" class="btn btn-danger btn-sm col-xs-2 " href="eliminar_confirmar_usuario.php?id=<?php echo $data["idusuario"] ?>" me-md-2>Eliminar</a>


                            <?php

                            }

                            ?>
                        </td>
                    </tr>
            <?php

                }
            }

            ?>
        </table>
        <center>
            <nav class="navbar navbar-light bg-light justify-content-center">

                <ul class="pagination">
                    <?php if ($pagina != 1) {


                    ?>

                        <li class="page-item">
                            <a class="page-link" href="?pagina=<?php echo $pagina - 1; ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                    <?php
                    }
                    for ($i = 1; $i <= $total_pagina; $i++) {
                        if ($i == $pagina) {
                            echo '<li class="pageSelected ">' . $i . '</li>';
                        } else {
                            echo '<li class="page-item"><a class="page-link" href="?pagina=' . $i . '">' . $i . '</a></li>';
                        }
                    }


                    if ($pagina != $total_pagina) {
                    ?>


                        <li class="page-item">
                            <a class="page-link" href="?pagina=<?php echo $pagina + 1; ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    <?php
                    }
                    ?>
                </ul>
            </nav>
        </center>
    </section>


    <?php include "includes/footer.php" ?>
</body>


</html>