<?php
if (!empty($_GET))
{
    $page = $_GET['page'];
}
else {
    $page = "Calzado";
}
$clases = array();
foreach($products as $product) {
    array_push($clases, $product['clase']);
}
$clases = array_unique($clases);
?>
<div class="container-nav-var">
    <div class="menu">
        <?php
        foreach($clases as $clase) {
        ?>
        <div class="item-menu <?php if ($page == $clase) echo 'active';?>">
            <a href="?page=<?php echo $clase;?>"><span><?php echo $clase;?></span></a>
        </div>
        <?php
        }
        ?>
        <div class="clear"></div>
    </div>
</div>