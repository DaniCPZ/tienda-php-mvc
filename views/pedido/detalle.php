<h1>Detalle del pedido</h1>
<?php if(isset($detalle_pedido)): ?>
    <?php if(isset($_SESSION['admin'])): ?>
        <h3>Cambiar estado del pedido</h3>
        <form action="<?=base_url.'pedido/estado'?>" method="POST">
            <input type="hidden" value="<?= $detalle_pedido->id?>" name="pedido_id">
            
            <select name="estado" >
                <option value="confirm" <?= $detalle_pedido->estado == 'confirm' ? "selected" : "";?>>
                    Pendiente
                </option>
                <option value="preparation" <?= $detalle_pedido->estado == 'preparation' ? "selected" : "";?>>
                En preparacion
                </option>                
                <option value="ready" <?= $detalle_pedido->estado == 'ready' ? "selected" : "";?>>
                Listo para enviar
                </option>
                <option value="sended" <?= $detalle_pedido->estado == 'sended' ? "selected" : "";?>>
                Enviado
                </option>
            </select>
            <input type="submit" value="Cambiar estado">
        </form>

        <br>
    <?php endif; ?>

    <h3>Direccion del envio</h3>
    Provincia:  <?=$detalle_pedido->provincia?><br>
    Ciudad:  <?=$detalle_pedido->localidad?><br>
    Direccion:  <?=$detalle_pedido->direccion?><br><br>
    <h3>Datos del pedido:</h3>
    Estado del pedido: <?= Utils::state($detalle_pedido->estado) ?><br>
    Numero de pedido: <?=$detalle_pedido->id?><br>
    Total a pagar: <?=$detalle_pedido->coste?> $<br>
    Productos:<br><br>
    <table>
    <tr>
        <th>Imagen</th>
        <th>Nombre</th>
        <th>Precio</th>
        <th>Unidades</th>
    </tr>
    <?php while($producto = $productos->fetch_object()):?>
        <tr>
            <td>
                <?php if($producto->imagen != null):?>
                    <img src="<?= base_url."uploads/images/".$producto->imagen?>" alt="<?=$producto->nombre?>" class="img_carrito"/>
                <?php else:?>  
                    <img src="<?=base_url?>assets/img/camiseta.png" class="img_carrito"/>
                <?php endif; ?> 
            </td>
            <td><?= $producto->nombre?></td>
            <td><?=$producto->precio?></td>
            <td><?= $producto->unidades?></td>
        </tr>
    <?php endwhile;?>
</table>
<?php endif; ?>