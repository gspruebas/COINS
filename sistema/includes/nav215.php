<nav>
	<ul>
		<li><a href="#">Inicio</a></li>


		<?php

        if ($_SESSION['role'] == 1) {


        ?>
		<li class="principal">
			<a href="#">Usuarios</a>
			<ul>
				<li><a href="registro_usuario.php">Nuevo Usuario</a></li>
				<li><a href="lista_usuario.php">Lista de Usuarios</a></li>
			</ul>
		</li>
			
		<?php

        }
?>

		<li class="principal">
			<a href="#">Colaborador</a>
			<ul>
				<li><a href="registro_colaborador.php">Nuevo Colaborador</a></li>
				<li><a href="lista_colaborador.php">Lista de Colaboradores</a></li>
			</ul>
		</li>
		
		<li class="principal">
			<a href="#">Clientes</a>
			<ul>
				<li><a href="registro_clientes.php">Nuevo Cliente</a></li>
				<li><a href="lista_clientes.php">Lista de Clientes</a></li>
			</ul>
		</li>

		<li class="principal">
			<a href="#">PROYECTO</a>
			<ul>
				<li><a href="#">Nuevo Proyecto</a></li>
				<li><a href="#">Lista de Proyecto</a></li>
			</ul>
		</li>

		<li class="principal">
			<a href="#">CAJAS</a>
			<ul>
				<li><a href="#">Nueva Caja</a></li>
				<li><a href="#">Lista de Cajas</a></li>
			</ul>
		</li>


		<li class="principal">
			<a href="#">Proveedores</a>
			<ul>
				<li><a href="#">Nuevo Proveedor</a></li>
				<li><a href="#">Lista de Proveedores</a></li>
			</ul>
		</li>
		<li class="principal">
			<a href="#">Productos</a>
			<ul>
				<li><a href="#">Nuevo Producto</a></li>
				<li><a href="#">Lista de Productos</a></li>
			</ul>
		</li>
		<li class="principal">
			<a href="#">Facturas</a>
			<ul>
				<li><a href="#">Nuevo Factura</a></li>
				<li><a href="#">Facturas</a></li>
			</ul>
		</li>
	</ul>
</nav>