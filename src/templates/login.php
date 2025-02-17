<div class="login-container <?php if(isset($errorLogin)){echo 'show';} ?>">
    <form action="<?php echo URL_BASE ?>/index.php" method="post">
        <h2>Ingresar</h2>
        <div class="inputs">
            <span>Usuario</span>
            <input type="text" name="user" />
        </div>
        <div class="inputs">
            <span>Contraseña</span>
            <input type="password" name="password" />
        </div>
        <?php  
        if(isset($errorLogin)) {
        ?>
        <div class="error">
            Valores incorrectos, vuelva a intentarlo
        </div>
        <?php } ?>
        <div class="inputs">
            <input type="submit" id="filtrar" name="ingresar" value="Ingresar" />
        </div>
    </form>
</div>