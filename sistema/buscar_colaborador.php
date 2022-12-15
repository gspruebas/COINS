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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>colaborador</title>
</head>
<style>
    /* 
=========colaborador============ */


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
        <?php

        $busqueda = strtolower($_REQUEST['busqueda']);
        if (empty($busqueda)) {
            {
                header("location: lista_colaborador.php");
                mysqli_close($conection);
            }
        }


        ?>


        <h1 class="display-1">colaborador</h1>
        <a href="registro_colaborador.php" type="button" class="btn btn-info">Crear colaborador</a>

        <nav class="navbar navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand">Gustavo</a>
                <form class="d-flex" action="buscar_colaborador.php" method="GET">
                    <input  class="form-control me-2" type="text" name="busqueda" id="busqueda" placeholder="BUSCAR" value="<?PHP echo $busqueda ?>">
                    <input type="submit" value="BUSCAR" class="btn btn-outline-success">
                </form>
            </div>
        </nav>

        <table class="table table-striped">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>dpi</th>
                <th>colaborador</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>

            <?php
            $rol = '';
            if($busqueda == 'Administrador'){
                $rol = "OR rol LIKE '%1%' ";
            }else if($busqueda == 'colaborador'){
                $rol = "OR rol LIKE '%2%' ";
            }else if($busqueda == 'colaborador 2'){
                $rol = "OR rol LIKE '%3%' ";
            }

            $sql_registe = mysqli_query($conection, "SELECT COUNT(*) as total_registro from colaborador
                                                    WHERE
                                                    (
                                                    idcolaborador LIKE '%$busqueda%' OR
                                                    nombre LIKE '%$busqueda%' OR
                                                    dpi LIKE '%$busqueda%' OR
                                                    colaborador LIKE '%$busqueda%' 
                                                    $rol)");

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


            $query = mysqli_query($conection, "SELECT u.idcolaborador, u.nombre, u.dpi, u.colaborador, r.rol FROM colaborador u INNER JOIN rolcolaborador r ON u.rol = r.idrol 
            where
            (u.idcolaborador LIKE '%$busqueda%' or
            u.nombre LIKE '%$busqueda%' OR
            u.dpi LIKE '%$busqueda%' OR
            u.colaborador LIKE '%$busqueda%' OR 
            r.rol like '%$busqueda%')
            
            ORDER BY u.idcolaborador ASC         
            limit $desde, $por_pagina");
            mysqli_close($conection);

            $result = mysqli_num_rows($query);

            if ($result > 0) {
                while ($data = mysqli_fetch_array($query)) {


            ?>

            <tr>
                <td>
                    <?php echo $data["idcolaborador"] ?>
                </td>
                <td>
                    <?php echo $data["nombre"] ?>
                </td>
                <td>
                    <?php echo $data["dpi"] ?>
                </td>
                <td>
                    <?php echo $data["colaborador"] ?>
                </td>
                <td>
                    <?php echo $data["rol"] ?>
                </td>


                <td>
                    <a type="button" class="btn btn-success btn-sm col-xs-2 "
                        href="editar_colaborador.php?id=<?php echo $data["idcolaborador"] ?>" me-md-2>Editar</a>

                    <?php

                    if ($data["idcolaborador"] != 1) {



                    ?>

                    <a type="button" class="btn btn-danger btn-sm col-xs-2 "
                        href="eliminar_confirmar_colaborador.php?id=<?php echo $data["idcolaborador"] ?>" me-md-2>Eliminar</a>


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

       <?php 
       
       if ($pagina != 1) {
        
       
       
       ?>
        <center>
            <nav class="navbar navbar-light bg-light justify-content-center">

                <ul class="pagination">
                    <?php if ($pagina != 1) {


                    ?>

                    <li class="page-item">
                        <a class="page-link" href="?pagina=<?php echo $pagina - 1; ?>&busqueda=<?php echo $busqueda; ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <?php
                    }
                    for ($i = 1; $i <= $total_pagina; $i++) {
                        if ($i == $pagina) {
                            echo '<li class="pageSelected ">' . $i . '</li>';
                        } else {
                            echo '<li class="page-item"><a class="page-link" href="?pagina=' . $i . '&busqueda='.$busqueda.'">' . $i . '</a></li>';
                        }
                    }


                    if ($pagina != $total_pagina) {
                    ?>


                    <li class="page-item">
                        <a class="page-link" href="?pagina=<?php echo $pagina + 1; ?>&busqueda=<?php echo $busqueda; ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                    <?php
                    }
                    ?>
                </ul>
            </nav>
        </center>

        <?php 
       
    
        
       }
       
       ?>
    </section>


    <?php include "includes/footer.php" ?>
</body>

</html>