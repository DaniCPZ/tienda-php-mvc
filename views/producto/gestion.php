<h1>Gestion de productos</h1>
<a href="<?=base_url?>producto/crear" class="button button-small">
    Crear producto
</a>
<?php if(isset($_SESSION['producto']) && $_SESSION['producto'] == 'complete'): ?>
    <strong class="alert_green">El producto se añadido correctamente</strong>
<?php elseif(isset($_SESSION['producto']) && $_SESSION['producto'] == 'failed'):?>
    <strong class="alert_red">El producto no se añadio correctamente</strong>
<?php endif;?>
<?php if(isset($_SESSION['delete']) && $_SESSION['delete'] == 'complete'): ?>
    <strong class="alert_green">El producto se añadido correctamente</strong>
<?php elseif(isset($_SESSION['delete']) && $_SESSION['delete'] == 'failed'):?>
    <strong class="alert_red">El producto no se añadio correctamente</strong>
<?php endif;?>
<?php Utils::deleteSession('producto'); ?>
<?php Utils::deleteSession('delete'); ?>
<table >
    <tr>
        <th>Id</th>
        <th>Nombre</th>
        <th>Precio</th>
        <th>Stock</th>
        <th>Acciones</th>
    </tr>
    <?php while($prod = $productos->fetch_object()): ?>
        <tr>
            <td><?= $prod->id;?></td>
            <td><?= $prod->nombre?></td>
            <td><?= $prod->precio?></td>
            <td><?= $prod->stock?></td>
            <td>
                <a href="<?=base_url?>producto/editar&id=<?=$prod->id?>" class="button button-gestion">Editar</a>
                <a href="<?=base_url?>producto/eliminar&id=<?=$prod->id?>" class="button button-gestion button-red">Eliminar</a>
            </td>
        </tr>        
    <?php endwhile;?>
</table>