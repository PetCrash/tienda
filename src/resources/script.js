$('.img-editar').on('click', function() {
    var url = window.location;
    var url_base = url.origin;
    var url_actual = url.href;
    var text_src = url_base + "/templates/edit-product.php?id=" + $(this).attr("id")+ "&url=" + url_actual;
    $('.iframe-edit').attr('src', text_src);
  });