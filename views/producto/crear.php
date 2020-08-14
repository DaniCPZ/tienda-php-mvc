<?php if(isset($edit) && isset($product) && is_object($product)):?>
    <h1>Editar producto <?= $product->nombre?></h1>
    <?php $url_action = base_url."producto/save&id=".$product->id; ?>
<?php else: ?>
    <h1>Crear nuevos productos</h1>
    <?php $url_action = base_url."producto/save"; ?>
<?php endif ?>

<div class="form_container">
    <form action="<?= $url_action ?>" method="POST" enctype="multipart/form-data">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" value="<?= isset($product) && is_object($product) ? $product->nombre : "";?>"/>

        <label for="descripcion">Descripcion</label>
        <textarea name="descripcion"><?= isset($product) && is_object($product) ? $product->descripcion : "";?></textarea>

        <label for="precio">Precio</label>
        <input type="text" name="precio" value="<?= isset($product) && is_object($product) ? $product->precio : "";?>"/>

        <label for="stock">Stock</label>
        <input type="number" name="stock" value="<?= isset($product) && is_object($product) ? $product->stock : "";?>"/>

        <?php $categorias = Utils::showCategorias(); ?>
        <label for="categoria">Categoría</label>
        <select name="categoria">
            <?php while($cat = $categorias->fetch_object()):?>
                <option value="<?=$cat->id?>" <?= isset($product) && is_object($product) && $cat->id == $product->categoria_id ? "selected" : "";?>>
                    <?=$cat->nombre?>
                </option>
            <?php endwhile;?>
        </select>

        <label for="imagen">Imagen</label>
        <?php if(isset($product) && is_object($product) && !empty($product->imagen)):?>            
            <img src="<?=base_url?>uploads/images/<?= $product->imagen?>" class="thumb"/><br>
        <?php endif; ?>

        <input type="file" name="imagen"/>
        <input type="submit" value="Guardar"/>
    </form>
</div>