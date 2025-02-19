<?php
session_start();
if (isset($_GET["logout"])) {
    session_unset();
    session_destroy();
}
include_once("config.php");
$dbConn = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

if(isset($_GET['page'])){
    $clase = $_GET['page'];
}
else {
    $clase = "Zapatillas";
}

/* LOGIN */
if(isset($_POST["ingresar"])){
    $name = $_POST["user"];
    $password = sha1($_POST["password"]);
    $query = "SELECT * FROM users WHERE name = '{$name}' AND password = '{$password}'";
    $result = $dbConn->query($query);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['id_user'] = $row['id_user'];
        $_SESSION['user_name'] = $row['name'];
    }
    else {
        $errorLogin = 1;
    }
}

/* Editar producto */
if(isset($_POST["edit-submit"])){
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    if(!empty($_POST['color'])){ $color = $_POST['color'];} else {$color = null;}
    if(!empty($_POST['vendendor'])){ $vendendor = $_POST['vendendor'];} else {$vendendor = null;}
    if(!empty($_POST['cliente'])){ $cliente = $_POST['cliente'];} else {$cliente = null;}
    if(isset($_POST['vendido'])){ $vendido = $_POST['vendido'];} else {$vendido = 0;}
    if(isset($_POST['pagado-cliente'])){ $pagadoCliente = $_POST['pagado-cliente'];} else {$pagadoCliente = 0;}
    if(isset($_POST['pagado-fernando'])){ $pagadoFernando = $_POST['pagado-fernando'];} else {$pagadoFernando = 0;}
    $query = "UPDATE producto SET nombre = '{$nombre}', vendido = '{$vendido}', pagada_cliente = '{$pagadoCliente}', pagada_fernando = '{$pagadoFernando}'";
    if(!empty($color)){ $query .= ", color = '{$color}'";}
    if(!empty($vendendor)){ $query .= ", vendendor = '{$vendendor}'";}
    if(!empty($cliente)){ $query .= ", cliente = '{$cliente}'";}
    $query .= " WHERE id = {$id}";
    $dbConn->query($query);
    if(isset($_POST['url'])){
        header('Location: '.$_POST['url']);
    }
}

$tallas = array();
if(isset($_POST['talla'])){
    $tallas = $_POST['talla'];
}

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
        if($product["clase"] == "Zapatillas" || $product["clase"] == "Chanclas"){
            if(!in_array((int) $product["talla"], $tallaProduct)){
                array_push($tallaProduct, (int) $product["talla"]);
            }
        }
        else {
            if(!in_array($product["talla"], $tallaProduct)){
                array_push($tallaProduct, $product["talla"]);
            }
        }
    }
}
$web = "tienda";
?>
<!DOCTYPE html>
<html>
<head>
<title>PetCrash Shop</title>
<link rel="stylesheet" href="resources/style.css?v=1.6">
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
        <div class="contact-info"><span>Si te interesa algún artículo puedes contactar a través del WhatsApp 616285711</span></div>
        <?php 
        include_once("templates/login.php");
        include_once("templates/menu-user.php");
        include_once("templates/nav-bar.php"); 
        include_once("templates/nav-filter.php");
        include_once("templates/edit-container.php");
        ?>
        <div class="content">
        <?php
        foreach ($products as $product) {
            if(!empty($tallas) && !in_array((int) $product['talla'], $tallas)) {
                if(!in_array($product['talla'], $tallas)){
                    continue;
                }
            }
        ?>
            <div class="article <?php if($product['clase'] != "Zapatillas" && $product['clase'] != "Chanclas"){ echo 'ropa';} ?>">
                <div class="image">
                    <img src="<?php echo $product['url']; ?>" />
                </div>
                <div class="description">
                    <h3><?php echo $product['nombre']; ?></h3>
                    <div class="text">
                        <?php if(isset($_SESSION['id_user'])){ ?>
                        <div class="button-editar"><img class="img-editar" id="<?php echo $product['id']; ?>" src="resources/images/editar.png" /></div>
                        <?php } ?>
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
include_once "templates/footer.php";
?>