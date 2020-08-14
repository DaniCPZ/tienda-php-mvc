<?php if(isset($cat)):?>
    <h1><?= $cat->nombre ?></h1>    
    <?php if($productos->num_rows == 0):?>
        <p>No hay productos para mostrar</p>
    <?php else:?>  
        <?php while($prod = $productos->fetch_object()): ?>
            <div class="product">
                <a href="<?=base_url."producto/ver&id=".$prod->id?>">
                    <?php if($prod->imagen != null):?>
                        <img src="<?= base_url."uploads/images/".$prod->imagen?>" alt="<?=$prod->nombre?>"/>
                    <?php else:?>  
                        <img src="<?=base_url?>assets/img/camiseta.png" />
                    <?php endif; ?>                
                    <h2><?=$prod->nombre?></h2>
                </a>
                
                <p><?=$prod->precio?></p>
                <a href="<?=base_url."carrito/add&id=".$prod->id?>" class="button">Comprar</a>
            </div>
        <?php endwhile;?>
    <?php endif;?>
<?php else:?>
    <h1>No existe la categoria</h1>
<?php endif;?>