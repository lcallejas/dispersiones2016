<?php 
	$permisos = $_SESSION['permisos'];
?>
<div id="menu">
	<ul>
  	    <li class="nivel1"><a href="../principal/indexPrincipal.php" class="nivel1">Inicio</a></li>
  		<li class="nivel1"><a href="#" class="nivel1 desactivado">Administrador</a>
			<ul>
				<li class="titulo2"><a href="#" class="desactivado">Usuarios</a></li>
				<?php
					if($permisos == 1 || $permisos == 2){
						echo "<li><a href='../usuarios/nuevoUsuario.php'>Nuevo</a></li>";
					}else{
						echo "<li><a href='#'>Nuevo</a></li>";
					}
					if($permisos == 1 || $permisos == 6){
						echo "<li><a href='../usuarios/modificarUsuarios.php'>Modificar</a></li>";
					}else{
						echo "<li><a href='#'>Modificar</a></li>";
					}
					if($permisos == 1){
						echo "<li><a href='../usuarios/eliminarUsuario.php'>Eliminar</a></li>";
					}else{
						echo "<li><a href='#'>Eliminar</a></li>";
					}
				?>
				<li class="titulo2"><a href="#" class="desactivado">Empresas</a></li>
				<?php
					if($permisos == 1 || $permisos == 2){
						echo "<li><a href='../empresas/nuevaEmpresa.php'>Nueva</a></li>";
					}else{
						echo "<li><a href='#'>Nueva</a></li>";
					}
					if($permisos == 1 || $permisos == 6){
						echo "<li><a href='../empresas/modificarEmpresas.php'>Modificar</a></li>";
					}else{
						echo "<li><a href='#'>Modificar</a></li>";
					}
					if($permisos == 1){
						echo "<li><a href='../empresas/eliminarEmpresa.php'>Eliminar</a></li>";
					}else{
						echo "<li><a href='#'>Eliminar</a></li>";
					}
				?>
				<li class="titulo2"><a href="#" class="desactivado">Movimientos</a></li>
				<?php
					if($permisos == 1 || $permisos == 6){
						echo "<li><a href='../movimientos/modificaProceso.php'>Modificar</a></li>";
					}else{
						echo "<li><a href='#''>Modificar</a></li>";
					}
					/*
					if($permisos == 1){
						echo "<li><a href='#''>Eliminar</a></li>";
					}else{
						echo "<li><a href='#''>Eliminar</a></li>";
					}
					*/
				?>
				<li class="titulo2"><a href="#" class="desactivado">Limites</a></li>
				<?php
					if($permisos == 1 || $permisos == 6){
						echo "<li><a href='../empresas/limites.php'>Editar Límites</a></li>";
					}else{
						echo "<li><a href='#''>Editar Límites</a></li>";
					}
				?>
			</ul>
		</li>  
		<li class="nivel1"><a href="#" class="nivel1 desactivado">Nuevo Movimiento</a>
			<ul>
				<?php
					if($permisos == 1 || $permisos == 2){
						echo "<li><a href='../movimientos/nuevoProcesoDirecto.php'>Directo</a></li>";
					}else{
						echo "<li><a href='#'>Directo</a></li>";
					}
					if($permisos == 1 || $permisos == 2){
						echo "<li><a href='../movimientos/nuevoProcesoNominas.php'>Nominas</a></li>";
					}else{
						echo "<li><a href='#'>Nominas</a></li>";
					}
					if($permisos == 1 || $permisos == 2){
						echo "<li><a href='../movimientos/nuevoProcesoSimple.php'>Simple</a></li>";
					}else{
						echo "<li><a href='#''>Simple</a></li>";
					}
					if($permisos == 1 || $permisos == 2){
						echo "<li><a href='../movimientos/nuevoProcesoPrestamo.php'>Prestamo</a></li>";
					}else{
						echo "<li><a href='#''>Prestamo</a></li>";
					}
				?>
			</ul>
		</li>
		<?php
			if($permisos == 1 || $permisos == 2 || $permisos == 3 || $permisos == 4){
				echo "<li class='nivel1'><a href='../movimientos/continuaProceso.php' class='nivel1'>Seguimiento</a></li>";
			}else{
				echo "<li class='nivel1'><a href='#' class='nivel1'>Seguimiento</a></li>";
			}
		?>  
		<li class="nivel1"><a href="#" class="nivel1 desactivado">Facturas</a>
			<ul>
				<?php
					if($permisos == 1 || $permisos == 2 || $permisos == 3 || $permisos == 5){
						echo "<li><a href='../movimientos/facturarProceso.php'>Contabilidad</a></li>";
					}else{
						echo "<li><a href='#'>Contador</a></li>";
					}
					if($permisos == 1 || $permisos == 2 || $permisos == 3 || $permisos == 4 || $permisos == 5){
						echo "<li><a href='../movimientos/facturarDispersiones.php'>Dispersiones</a></li>";
					}else{
						echo "<li><a href='#'>Dispersiones</a></li>";
					}
				?>
			</ul>
		</li>
		<li class="nivel1"><a href="#" class="nivel1 desactivado">Listados</a>
			<ul>
				<?php
				if($permisos == 1 || $permisos == 2 || $permisos == 3 || $permisos == 4 || $permisos == 5){
					echo "<li><a href='../listados/listadoFinales.php'>Finales</a></li>";
				}else{
					echo "<li><a href='#'>Finales</a></li>";
				}
				if($permisos == 1 || $permisos == 2 || $permisos == 3 || $permisos == 5){
					echo "<li><a href='../nominas/nominaspdf.php'>Nóminas</a></li>";
				}else{
					echo "<li><a href='#'>Nóminas</a></li>";
				}
				?>
				
			</ul>
		</li>
  		<li class="nivel1"><a href="../php/cerrar_sesion.php" class="nivel1">Cerrar Sesión</a></li>
	</ul>
</div>