<?php
include_once("config.php");

if(isset($_GET['page'])){
    $clase = $_GET['page'];
}

$tallas = array();
if(isset($_POST['talla'])){
    $tallas = $_POST['talla'];
}

$dbConn = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
$query = "SELECT * from producto LEFT JOIN product_images ON producto.id = product_images.id_product WHERE producto.vendido = 0";
if(isset($clase)){
    $query .= " AND clase = '{$clase}'";
}
$result = $dbConn->query($query);
$products = array();
$tallaProduct = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $product = $row;
        array_push($products, $product);
        if(!in_array((int) $product["talla"], $tallaProduct)){
            array_push($tallaProduct, (int) $product["talla"]);
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>PetCrash Shop</title>
<link rel="stylesheet" href="resources/style.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="title">
                <h1>PetCrash Shop</h1>
                <div class="menu-button">
                    <img class="img-menu" src="resources/images/button-menu.gif" />
                </div>
            </div>
        </div>
        <?php 
        include_once("templates/nav-bar.php"); 
        include_once("templates/nav-filter.php");
        ?>
        <div class="content">
        <?php
        foreach ($products as $product) {
            if(!empty($tallas) && !in_array((int) $product['talla'], $tallas)) {
                continue;
            }
        ?>
            <div class="article">
                <div class="image">
                    <img src="<?php echo $product['url']; ?>" />
                </div>
                <div class="description">
                    <h3><?php echo $product['nombre']; ?></h3>
                    <div class="text">
                        <span><?php echo $product['color']; ?></span><br />
                        <span>Talla: <?php echo $product['talla']; ?></span><br />
                        <span>Identificador: <?php echo $product['id']; ?></span><br />
                        <div class="price">
                            <span><?php echo number_format($product['precio'], 2); ?>€</span>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        </div>
    </div>
<?php
$script = '
$(".img-menu").on("click", function(){
    $(".menu").toggleClass("show");
});
';
include_once "templates/footer.php";
?>