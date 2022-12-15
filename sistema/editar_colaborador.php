<?php
session_start();

if($_SESSION['role'] != 1)
{
    header('location: ./');
}


include "../conexion.php";


if (!empty($_POST)) {
    $alert = '';
    if (empty($_POST['nombre']) || empty($_POST['dpi']) || empty($_POST['colaborador']) || empty($_POST['rol'])) {
        $alert = '<p class="msg_error"> Todos los campos son obligatorios</p>';
    } else {

        $idColaborador = $_POST['idcolaborador']; 
        $nombre = $_POST['nombre'];
        $email = $_POST['dpi'];
        $user = $_POST['colaborador'];
        $clave = md5($_POST['clave']);
        $rol = $_POST['rol'];



        $query = mysqli_query($conection, "SELECT * FROM colaborador 
        where(colaborador = '$user' and idcolaborador != $idColaborador)
          OR (dpi = '$email' and idcolaborador != $idColaborador)");



        $result = mysqli_fetch_array($query);

        if ($result > 0) {
            $alert = '<p class="msg_error"> El dpi o el colaborador ya existen</p>';
        } else {
            
            if(empty($_POST['clave']))
            {
                $sql_update = mysqli_query($conection, "UPDATE colaborador
                SET nombre = '$nombre', dpi = '$email', colaborador='$user', rol = '$rol'
                WHERE idcolaborador = '$idColaborador'");
            }else{
                $sql_update = mysqli_query($conection, "UPDATE colaborador
                                                SET nombre = '$nombre', dpi = '$email', colaborador='$user', clave='$clave', rol = '$rol'
                                                where idcolaborador = '$idColaborador");
            }

            if ($sql_update) {
                $alert = '<p class="msg_save"> colaborador actualizado correctamente</p>';
            } else {
                $alert = '<p class="msg_error"> Error en la actualizaciòn del colaborador</p>';
            }
        }
    }
    mysqli_close($conection);
}

//mostrar datos 
if (empty($_GET['id'])) {
    header('Location: lista_colaborador.php');
    mysqli_close($conection);
}
$iduser = $_GET['id'];

$sql = mysqli_query($conection, "SELECT u.idcolaborador, u.nombre, u.dpi, u.colaborador, (u.rol) as idrol, (r.rol) as rol 
FROM colaborador u 
INNER JOIN rolcolaborador r 
on u.rol = r.idrol 
WHERE idcolaborador= $iduser");

mysqli_close($conection);

$result_sql = mysqli_num_rows($sql);
if($result_sql == 0){
    header('Location: lista_colaborador.php');
}else{

    $option = '';

    while ($data = mysqli_fetch_array($sql)){
        $iduser = $data['idcolaborador'];
        $nombre = $data['nombre'];
        $dpi = $data['dpi'];
        $usario = $data['colaborador'];
        $idrol = $data['idrol'];
        $rol = $data['rol'];

        if($idrol == 1){
$option = ' <option value="'.$idrol.'" select>'.$rol.'</option>';
        }elseif($idrol == 2){
            $option = ' <option value="'.$idrol.'" select>'.$rol.'</option>';      
        }elseif($idrol == 3){
            $option = ' <option value="'.$idrol.' select">'.$rol.'</option>';
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
    <title>Actualizar colaborador</title>
</head>
<style>
    .notItemOne option:first-child{
    display: none;
}
</style>
<body>
    <?php include "includes/header.php"; ?>
    <section id="container">
        <div class="form_register">

            <h1>Actualiza colaborador</h1>
            <hr>
            <div class="alert">
                <?php echo isset($alert) ? $alert : ''; ?>
            </div>
            <form actions="" method="post">
            
                <input type="hidden" name="idcolaborador" value="<?php echo $iduser; ?>">


                <!-- nombre -->
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" placeholder="Nombre Completo" value="<?php echo $nombre; ?>">

                <!-- dpi -->

                <label for="dpi">dpi electronico</label>
                <input type="text" name="dpi" id="dpi" placeholder="dpi electronico" value="<?php echo $dpi; ?>">

                <!-- colaborador -->

                <label for="colaborador">colaborador</label>
                <input type="text" name="colaborador" id="colaborador" placeholder="colaborador" value="<?php echo $usario; ?>">

                <!-- Clave -->

                <label for="clave">contraseña</label> 
                <input type="password" name="clave" id="clave" placeholder="clave de acceso">

                <!-- rol -->

                <label for="rol">tipo de colaborador</label>

                <?php
                include "../conexion.php";
                
                $query_rol = mysqli_query($conection, "SELECT * FROM rolcolaborador");
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

                <input type="submit" value="Actualizar colaborador" class="btn_save">
            </form>
        </div>



    </section>


    <?php include "includes/footer.php"; ?>
</body>


</html>