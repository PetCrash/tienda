<?php
include_once("../config.php");
$idProduct = $_GET['id'];
$dbConn = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
$query = "SELECT * from producto WHERE id = {$idProduct}";
$result = $dbConn->query($query);
if ($result->num_rows > 0) {
    $product = $result->fetch_assoc();
    if($product['pagada_fernando'] == 0){$pagadaFernando = "NO";} else {$pagadaFernando = "SÍ";}
    if($product['pagada_cliente'] == 0){$pagada = "NO";} else {$pagada = "SÍ";}
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
<div class="container-info">
    <div class="info-product"><span class="negrita">Vendido por:</span> <?php echo $product['vendedor']; ?></div>
    <div class="info-product"><span class="negrita">Cliente:</span> <?php echo $product['cliente']; ?></div>
    <div class="info-product"><span class="negrita">Pagado:</span> <?php echo $pagada; ?></div>
    <div class="info-product"><span class="negrita">Pagado a Fernando:</span> <?php echo $pagadaFernando; ?></div>
</div>
</body>
</html>