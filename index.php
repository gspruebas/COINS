<?php

$alert = '';

session_start();
if(!empty($_SESSION['active']))
{
    header('location: sistema/');
}else{



    if (!empty($_POST)) 
        {
            if (empty($_POST['usuario']) || empty($_POST['clave'])) 
            {
                $alert = 'Ingrese su Usuario y su Clave';
            }else{

            require_once "conexion.php";

            $user = mysqli_real_escape_string($conection, $_POST['usuario']);
            $pass = md5(mysqli_real_escape_string($conection, $_POST['clave']));

            $query = mysqli_query($conection, "SELECT * FROM usuario WHERE usuario= '$user' AND clave = '$pass'");
            mysqli_close($conection);
            $result = mysqli_num_rows($query);

            if ($result > 0) 
            {
                $data = mysqli_fetch_array($query);
                $_SESSION['active'] = true;
                $_SESSION['idUser'] = $data['idusuario'];
                $_SESSION['nombre'] = $data['nombre'];
                $_SESSION['email'] = $data['email'];
                $_SESSION['user'] = $data['usuario'];
                $_SESSION['role'] = $data['rol'];

                header('location: sistema/');

            }else{
                $alert = 'El usuario o la clave no existe';
                session_destroy();
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>COINS</title>
</head>

<body>
    <section id="container">

        <form action="" method="post">

            <H3>Iniciar Sesión</H3>
            <img src="img/logo.jpg" alt="Login" width="100px" height="100px">


            <input type="text" name="usuario" placeholder="Usuario">
            <input type="password" name="clave" placeholder="contraseña">
            <center>
            <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
            </center>
            <input type="submit" value="INGRESAR" class="btn btn-outline-secondary">


        </form>

    </section>
</body>

</html>



