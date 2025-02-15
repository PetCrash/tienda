<?php
session_start();
if (isset($_GET["logout"])) {
    session_unset();
    session_destroy();
}
include_once("config.php");
$dbConn = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

$query = "SELECT * from producto WHERE vendido = 1";
$result = $dbConn->query($query);
$productsPaid = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $product = $row;
        array_push($productsPaid, $product);
    }
}
$web = "informes";
?>
<!DOCTYPE html>
<html>
<head>
<title>PetCrash Shop</title>
<link rel="stylesheet" href="resources/style.css?v=1.4">
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="title">
                <h1>PetCrash Shop</h1>
                <div class="menu-button">
                    <img class="img-menu" src="resources/images/button-menu.gif" />
                </div>
                <div class="button-login">
                    <?php if(isset($_SESSION["user_name"])){
                        echo '<img class="img-loged" src="resources/images/loged.png" />';
                    }
                    else {
                        echo '<img class="img-login" src="resources/images/login.png" />';
                    }?>
                </div>
            </div>
        </div>
        <?php 
        include_once("templates/login.php");
        include_once("templates/menu-user.php");
        include_once("templates/edit-container.php");
        ?>
        <div class="content">
            <div class="title-content">
                <h2>Informes</h2>
            </div>
            <div class="container-paid">
                <h3>Productos vendidos</h3>
                <div class="row-product negrita titulo">
                    <div class="products product-id">ID</div>
                    <div class="products product-name">Nombre</div>
                    <div class="products product-size">Talla</div>
                    <div class="products product-price">Precio</div>
                    <div class="products product-client">Cliente</div>
                    </div>
                <?php
                foreach($productsPaid as $product){
                ?>
                    <div class="row-product">
                        <div class="products product-id"><?php echo $product["id"]; ?></div>
                        <div class="products product-name"><?php echo $product["nombre"]; ?></div>
                        <div class="products product-size"><?php echo $product["talla"]; ?></div>
                        <div class="products product-price"><?php echo number_format($product["precio"], 2); ?>€</div>
                        <div class="products product-client"><?php echo $product["cliente"]; ?></div>
                        <div class="button-editar"><img class="img-editar" id="<?php echo $product['id']; ?>" src="resources/images/editar.png" /></div>
                    </div>
                <?php } ?>
            </div>
            <div class="container-non-liquidated">
                <h3>Productos pagados</h3>
                <div class="row-product negrita titulo">
                    <div class="products product-id">ID</div>
                    <div class="products product-name">Nombre</div>
                    <div class="products product-size">Talla</div>
                    <div class="products product-price">Precio</div>
                    <div class="products product-client">Cliente</div>
                    </div>
                <?php
                foreach($productsPaid as $product){
                    if($product["pagada_cliente"] == 1){
                ?>
                        <div class="row-product">
                        <div class="products product-id"><?php echo $product["id"]; ?></div>
                        <div class="products product-name"><?php echo $product["nombre"]; ?></div>
                        <div class="products product-size"><?php echo $product["talla"]; ?></div>
                        <div class="products product-price"><?php echo number_format($product["precio"], 2); ?>€</div>
                        <div class="products product-client"><?php echo $product["cliente"]; ?></div>
                        <div class="button-editar"><img class="img-editar" id="<?php echo $product['id']; ?>" src="resources/images/editar.png" /></div>
                    </div>
                <?php    
                    }    
                } ?>
            </div>
            <div class="container-liquidated">
                <h3>Productos liquidados</h3>
                <div class="row-product negrita titulo">
                    <div class="products product-id">ID</div>
                    <div class="products product-name">Nombre</div>
                    <div class="products product-size">Talla</div>
                    <div class="products product-price">Precio</div>
                    <div class="products product-client">Cliente</div>
                    </div>
                <?php
                foreach($productsPaid as $product){
                    if($product["pagada_fernando"] == 1){
                ?>
                        <div class="row-product">
                        <div class="products product-id"><?php echo $product["id"]; ?></div>
                        <div class="products product-name"><?php echo $product["nombre"]; ?></div>
                        <div class="products product-size"><?php echo $product["talla"]; ?></div>
                        <div class="products product-price"><?php echo number_format($product["precio"], 2); ?>€</div>
                        <div class="products product-client"><?php echo $product["cliente"]; ?></div>
                        <div class="button-editar"><img class="img-editar" id="<?php echo $product['id']; ?>" src="resources/images/editar.png" /></div>
                    </div>
                <?php    
                    }    
                } ?>
            </div>
        </div>
    </div>
<?php
include_once "templates/footer.php";
?>