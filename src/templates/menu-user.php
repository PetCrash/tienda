<div class="menu-user-container">
    <?php if($web == "tienda"){ ?>
        <a href="<?php echo URL_BASE;?>/informe-ventas.php">
            <div class="button-menu-user">
            Informe ventas
            </div>
        </a>
    <?php } else if($web == "informes"){ ?>
        <a href="<?php echo URL_BASE;?>">
            <div class="button-menu-user">
            Tienda
            </div>
        </a>
    <?php } ?>
    <a href="<?php echo URL_BASE;?>?logout=1">
        <div class="button-menu-user">
        Desconectar
        </div>
    </a>
</div>