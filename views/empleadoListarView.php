<?php
// Incluimos la autentificación
include_once("common/autentificacion.php"); ?>

<?php include_once("common/cabecera.php"); ?>

<body>
    <?php include_once("common/menu.php"); ?>

    <div class="container md-col-offset-2">
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Departamento</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($items as $item) {
                    ?>
                    <tr>
                        <td>
                            <?php echo $item->getCodigo() ?>
                        </td>
                        <td>
                            <?php echo $item->getNombre() ?>
                        </td>
                        <td>
                            <?php echo $item->getDepartamentoDescripcion() ?>
                        </td>
                        <td>
                            <a href="index.php?controlador=Empleado&accion=editar&codigo=<?php echo $item->getCodigo() ?>"
                                class="btn btn-primary btn-xs">Editar</a>
                        </td>
                        <td>
                            <a href="index.php?controlador=Empleado&accion=borrar&codigo=<?php echo $item->getCodigo() ?>"
                                class="btn btn-danger btn-xs">Borrar</a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <a href="index.php?controlador=Empleado&accion=nuevo" class="btn btn-success">Nuevo</a>
    </div>

    <!-- Incluimos el pie de página -->
    <?php include_once("common/pie.php"); ?>
</body>

</html>