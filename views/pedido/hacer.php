<?php if(isset($_SESSION['identity'])): ?>
    <h1>Finalizar pedido</h1>
    <p>
        <a href="<?=base_url."carrito/index"?>">Ver los productos del carrito</a>
    </p><br>
    <h3>Domicilio para el envio</h3>
    <form action="<?=base_url?>pedido/add" method="POST">
        <label for="provincia">Provincia</label>
        <input type="text" name="provincia" />

        <label for="localidad">Localidad</label>
        <input type="text" name="localidad" />

        <label for="direccion">Direccion</label>
        <input type="text" name="direccion" />
        
        <input type="submit" value="Confirmar" />
    </form>
<?php else: ?>
    <h1>Necesitas estar identificado</h1>
    <p>Necesitas estar logueado en la web para poder realizar tu pedido.</p>
<?php endif; ?>
