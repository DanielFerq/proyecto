<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data['title']; ?></title>
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/admin-estilos/css/ticked.css">
</head>
<body>
    <img src="" alt="">
    <div class="datos-empresa">
        <p><?php echo $data['empresa']['nombreconfig']; ?></p>
        <p><?php echo $data['empresa']['celular']; ?></p>
        <p><?php echo $data['empresa']['direccion']; ?></p>
    </div>
    <h5 class="title">Datos del Proveedor</h5>
    <div class="datos-info">
        <p>Ruc: <?php echo $data['compra']['ruc']; ?></p>
        <p>Nombre: <?php echo $data['compra']['nombre']; ?></p>
        <p>Teléfono: <?php echo $data['compra']['telefono']; ?></p>
    </div>

    <h5 class="title">Detalle de los Productos</h5>
    <table class="table table-light">
        <thead>
            <tr>
                <th>Cant.</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>SubTotal</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $productos = json_decode($data['compra']['productos'],true);
                foreach ($productos as $producto) { ?>
                <tr>
                    <td><?php echo $producto['cantidad']; ?></td>
                    <td><?php echo $producto['nombre']; ?></td>
                    <td><?php echo number_format($producto['precio'], 2); ?></td>
                    <td><?php echo number_format($producto['cantidad'] * $producto['precio'],2); ?></td>
                    <td><?php echo $producto['']; ?></td>
                </tr>
                <?php } ?>
                <tr>
                    <td>Total</td>
                    <td colspan="3"><?php echo number_format($data['compra']['total'],2); ?></td>
                </tr>
        </tbody>
    </table>
    <div class="mensaje">
        <?php echo $data['empresa']['mensaje']; ?>
    </div>
</body>
</html>