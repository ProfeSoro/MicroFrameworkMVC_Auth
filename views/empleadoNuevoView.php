<?php
// Incluimos el fichero de autentificación
include_once("common/autentificacion.php"); ?>

<!-- Incluimos la cabecera -->
<?php include_once("common/cabecera.php"); ?>

<!-- Vista para editar un elemento de la tabla -->

<body>
	<!-- Incluimos un menú para la aplicación -->
	<?php include_once("common/menu.php"); ?>

	<div class="container md-col-offset-2">

		<!-- Parte específica de nuestra vista -->
		<!-- Formulario para insertar un nuevo item -->
		<form action="index.php" method="post">
			<input type="hidden" name="controlador" value="Empleado">
			<input type="hidden" name="accion" value="nuevo">

			<?php echo isset($errores["nombre"]) ? "*" : "" ?>
			<div class="form-group">
				<label for="nombre">Nombre</label>
				<input class="form-control" type="text" name="nombre">
			</div>

			<?php echo isset($errores["cod_depto"]) ? "*" : "" ?>
			<div class="form-group">
				<label for="cod_depto">Departamento</label>
				<select class="form-control" name="cod_depto">
					<?php
					// Recorremos la lista de departamentos para crear las opciones del select
					foreach ($lista_deptos as $depto) {
						echo "<option value='" . $depto->getCodigo() . "'>" . $depto->getNombre() . "</option>";
					}
					?>
				</select>
			</div>

			<input class="btn btn-success btn-block" type="submit" name="submit" value="Aceptar">
		</form>
	</div>
	</br>

	<?php
	// Si hay errores se muestran
	if (isset($errores)):
		foreach ($errores as $key => $error):
			echo $error . "</br>";
		endforeach;
	endif;
	?>

	<!-- Incluimos el pie de la página -->
	<?php include_once("common/pie.php"); ?>
</body>

</html>