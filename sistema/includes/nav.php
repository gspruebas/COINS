
<nav>
	<ul>
		<li><a href="#"><i class="fa-sharp fa-solid fa-house"></i> Inicio</a></li>


		<?php

		if ($_SESSION['role'] == 1) {


		?>
			<li class="principal">
				<a href="#"><i class="fa-solid fa-users"></i> Usuarios</a>
				<ul>
					<li><a href="registro_usuario.php"><i class="fa-solid fa-plus"></i>  Nuevo Usuario</a></li>
					<li><a href="lista_usuario.php"><i class="fa-sharp fa-solid fa-book-open"></i>  Lista de Usuarios</a></li>
				</ul>
			</li>

		<?php

		}
		?>

		<li class="principal">
			<a href="#"><i class="fa-solid fa-users"></i> Colaborador</a>
			<ul>
				<li><a href="registro_colaborador.php"><i class="fa-solid fa-plus"></i>  Nuevo Colaborador</a></li>
				<li><a href="lista_colaborador.php"><i class="fa-sharp fa-solid fa-book-open"></i>  Lista de Colaboradores</a></li>
			</ul>
		</li>

		<li class="principal">
			<a href="#"><i class="fa-solid fa-users"></i> Clientes</a>
			<ul>
				<li><a href="registro_clientes.php"><i class="fa-solid fa-plus"></i>  Nuevo Cliente</a></li>
				<li><a href="lista_clientes.php"><i class="fa-sharp fa-solid fa-book-open"></i>  Lista de Clientes</a></li>
			</ul>
		</li>

		<li class="principal">
			<a href="#"><i class="fa-solid fa-briefcase"></i> PROYECTO</a>
			<ul>
				<li><a href="#"><i class="fa-solid fa-plus"></i>  Nuevo Proyecto</a></li>
				<li><a href="#"><i class="fa-sharp fa-solid fa-book-open"></i>  Lista de Proyecto</a></li>
			</ul>
		</li>

		<li class="principal">
			<a href="#"><i class="fa-solid fa-warehouse"></i> CAJAS</a>
			<ul>
				<li><a href="#"><i class="fa-solid fa-plus"></i>  Nueva Caja</a></li>
				<li><a href="#"><i class="fa-sharp fa-solid fa-book-open"></i>  Lista de Cajas</a></li>
			</ul>
		</li>


		<li class="principal">
			<a href="#"><i class="fa-solid fa-truck-field-un"></i> Proveedores</a>
			<ul>
				<li><a href="#"><i class="fa-solid fa-plus"></i>  Nuevo Proveedor</a></li>
				<li><a href="#"><i class="fa-sharp fa-solid fa-book-open"></i>  Lista de Proveedores</a></li>
			</ul>
		</li>
		<li class="principal">
			<a href="#"><i class="fa-solid fa-layer-group"></i> Productos</a>
			<ul>
				<li><a href="#"><i class="fa-solid fa-plus"></i>  Nuevo Producto</a></li>
				<li><a href="#"><i class="fa-sharp fa-solid fa-book-open"></i>  Lista de Productos</a></li>
			</ul>
		</li>
		<li class="principal">
			<a href="#"><i class="fa-solid fa-file-invoice"></i> Facturas</a>
			<ul>
				<li><a href="#"><i class="fa-solid fa-plus"></i>  Nuevo Factura</a></li>
				<li><a href="#"><i class="fa-sharp fa-solid fa-book-open"></i>  Facturas</a></li>
			</ul>
		</li>
	</ul>
</nav>