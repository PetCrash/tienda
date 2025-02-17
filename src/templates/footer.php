    <div class="footer">
        <span>Si te interesa algún artículo puedes contactar a través del WhatsApp 616285711</span>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.3.slim.min.js"
    integrity="sha256-ZwqZIVdD3iXNyGHbSYdsmWP//UBokj2FHAxKuSBKDSo=" crossorigin="anonymous"></script>
<?php
$script = '
$(".img-menu").on("click", function(){
    $(".menu").toggleClass("show");
});
$(".img-login").on("click", function(){
    $(".login-container").toggleClass("show");
});
$(".img-loged").on("click", function(){
    $(".menu-user-container").toggleClass("show");
});
$(".img-cerrar").on("click", function(){
    $(".container-edit-product").toggleClass("show");
});
$(".img-editar").on("click", function(){
    $(".container-edit-product").toggleClass("show");
});
var URL_BASE = "'.URL_BASE.'";
';
if (isset($script)) {
    echo "<script>$script</script>";
}
?>
<script src="<?php echo URL_BASE; ?>/resources/script.js"></script>
</body>
</html> 