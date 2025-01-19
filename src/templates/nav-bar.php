<?php
if (!empty($_GET))
{
    $page = $_GET['page'];
}
else {
    $page = "Calzado";
}

// Consulta para saber las clases diferentes que hay
$query = "SELECT DISTINCT clase FROM producto";
$result = $dbConn->query($query);
$clases = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        array_push($clases, $row["clase"]);
    }
}
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