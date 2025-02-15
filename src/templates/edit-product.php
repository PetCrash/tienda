<?php
include_once("../config.php");
$idProduct = $_GET['id'];
$hrefComprobar = URL_BASE."/";
if (isset($_GET['url']) && $_GET['url'] != $hrefComprobar){
    $urlActual = $_GET['url'];
}
$dbConn = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
$query = "SELECT * from producto WHERE id = {$idProduct}";
$result = $dbConn->query($query);
if ($result->num_rows > 0) {
    $product = $result->fetch_assoc();
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="<?php echo URL_BASE; ?>/resources/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <base target="_parent">
</head>
<body>
    <div class="container-edit">
        <h1>Editar producto</h1>
        <form method="post" action="<?php echo URL_BASE; ?>">
            <input type="hidden" name="id" value="<?php echo $idProduct ?>" />
            <?php if(isset($urlActual)){echo '<input type="hidden" name="url" value="'.$urlActual.'" />';} ?>
            <div class="campo-edit">
                <span class="span-input-text">Nombre:</span>
                <input class="input-nombre" type="text" name="nombre" value="<?php echo $product['nombre'] ?>" />
            </div>
            <div class="campo-edit">
                <span class="span-input-text">Color:</span>
                <input class="input-color" type="text" name="color" value="<?php echo $product['color'] ?>" />
            </div>
            <div class="campo-edit">
                <span class="span-checkbox">Vendido:</span>
                <div class="switch-button">
                    <input type="checkbox" name="vendido" id="vendido" class="switch-button__checkbox" value=1 <?php if($product['vendido'] == 1) {echo 'checked="checked"';} ?> />
                    <label for="vendido" class="switch-button__label"></label>
                </div>
            </div>
            <div class="campo-edit">
                <span class="span-input-text">Vendedor:</span>
                <input type="text" name="vendendor" value="<?php echo $product['vendedor'] ?>" />
            </div>
            <div class="campo-edit">
                <span class="span-input-text">Cliente:</span>
                <input type="text" name="cliente" value="<?php echo $product['cliente'] ?>" />
            </div>
            <div class="campo-edit">
                <span class="span-checkbox">Pagado cliente:</span>
                <div class="switch-button">
                    <input type="checkbox" name="pagado-cliente" id="pagado-cliente" class="switch-button__checkbox" value=1 <?php if($product['pagada_cliente'] == 1) {echo 'checked="checked"';} ?> />
                    <label for="pagado-cliente" class="switch-button__label"></label>
                </div>
            </div>
            <div class="campo-edit">
                <span class="span-checkbox">Pagado Fernando:</span>
                <div class="switch-button">
                    <input type="checkbox" name="pagado-fernando" id="pagado-fernando" class="switch-button__checkbox" value=1 <?php if($product['pagada_fernando'] == 1) {echo 'checked="checked"';} ?> />
                    <label for="pagado-fernando" class="switch-button__label"></label>
                </div>
            </div>
            <div class="campo-edit buton-edit">
                <input type="submit" name="edit-submit" class="edit-submit" value="Enviar" />
            </div>
        </form>
    </div>
</body>
</html>