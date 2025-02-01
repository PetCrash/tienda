<?php 
asort($tallaProduct);
?>

<div class="container-nav-filter">
    <div class="menu-filter">
        <form action="" method="post">
            <div class="filter-title"><span>Talla:</span></div>
        <?php foreach ($tallaProduct as $tallProd) { 
            if(isset($tallProd)){
        ?>
                <input type="checkbox" id="<?php echo $tallProd; ?>" name="talla[]" value="<?php echo $tallProd; ?>" <?php if(in_array($tallProd, $tallas)){echo 'checked= "checked"';}?> />
                <label class="label-checkbox" for="<?php echo $tallProd; ?>"><?php echo $tallProd; ?></label>
        <?php
            }
            else {
        ?>
            <input type="checkbox" id="<?php echo $tallProd; ?>" name="talla[]" value="<?php echo $tallProd; ?>" <?php if(in_array($tallProd, $tallas)){echo 'checked= "checked"';}?> />
            <label class="label-checkbox" for="<?php echo $tallProd; ?>"><?php echo $tallProd; ?></label>
            
        <?php }} ?>
            <br />
            <input type="submit" id="filtrar" value="Filtrar"/>
        </form>
    </div>
</div>