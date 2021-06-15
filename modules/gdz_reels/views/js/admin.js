$(document).ready(function() {
    function reIndex() {
        $('.count').each(function(i, e) {
            $(e).html(i+1);
        })
    }
    $('.product-select').chosen();
    $(document).on('click', '.delete-lookbook', function(e) {
        e.preventDefault();
        btn = $(this);
        btn.prop('disabled', true);
        id_lookbook = $(this).closest('.lookbook').attr('id-lookbook');
        id_reel = $('#id_reel').val();
        row = $(this).closest('.lookbook');
        $.ajax({
            type: 'post',
            url: $('#ajax_url').val(),
            data: {
                'action': 'deleteLookbook',
                'id_lookbook': id_lookbook,
                'id_reel': id_reel,
                'secure_key': $('#secure_key').val(),
            },
            success: function (result) {
                rs = JSON.parse(result);
                if (rs.success) {
                    row.remove();
                    reIndex();
                } else {
                    alert(rs.err);
                    btn.prop('disabled', false);
                }
            }
        })
    })
    $('#add-lookbook').click(function(e) {
        btn = $(this);
        btn.prop('disabled', true);
        id_reel = $('#id_reel').val();
        e.preventDefault();
        $.ajax({
            type: 'post',
            url: $('#ajax_url').val(),
            data: {
                'action': 'addLookbook',
                'id_reel': id_reel,
                'secure_key': $('#secure_key').val(),
            },
            success: function (result) {
                rs = JSON.parse(result);
                if (rs.success) {
                    $lookbook = $(rs.html);
                    $('#lookbooks').append($lookbook);
                    $lookbook.find('.product-select').chosen();
                    reIndex();
                } else {
                    alert(rs.err);
                }
                btn.prop('disabled', false);
            }
        })
    })
    $(document).on('click', '.add-product', function(e) {
        btn = $(this);
        btn.prop('disabled', true);
        e.preventDefault();
        form = $(this).closest('form');
        data = form.serialize();
        $.ajax({
            type: 'post',
            url: form.attr('action'),
            data: data,
            success: function (result) {
                rs = JSON.parse(result);
                if (rs.success) {
                    form.before(rs.html);
                    form.closest('products').find('.no-product').hide();
                } else {
                    alert(rs.err);
                }
                btn.prop('disabled', false);
            }
        })
    })
    $(document).on('click', '.delete-product', function(e) {
        e.preventDefault();
        btn = $(this);
        btn.prop('disabled', true);
        id_lookbook = $(this).closest('.products').attr('id-lookbook');
        row = $(this).closest('.product');
        $.ajax({
            type: 'post',
            url: $('#ajax_url').val(),
            data: {
                'action': 'deleteProduct',
                'id_lookbook': id_lookbook,
                'id_product': $(this).attr("id-product"),
                'secure_key': $('#secure_key').val(),
            },
            success: function (result) {
                rs = JSON.parse(result);
                if (rs.success) {
                    row.remove();
                } else {
                    alert(rs.err);
                    btn.prop('disabled', false);
                }
            }
        })
    })
    $(document).on('click', '.delete-reel', function(e) {
        e.preventDefault();
        btn = $(this);
        btn.prop('disabled', true);
        id_reel = btn.attr('id-reel');
        row = $(this).closest('.reel');
        $.ajax({
            type: 'post',
            url: $('#ajax_url').val(),
            data: {
                'action': 'deleteReel',
                'id_reel': id_reel,
                'secure_key': $('#secure_key').val(),
            },
            success: function (result) {
                rs = JSON.parse(result);
                if (rs.success) {
                    row.remove();
                } else {
                    alert(rs.err);
                    btn.prop('disabled', false);
                }
            }
        })
    })
    $(document).on('click', '.update-product', function(e) {
        e.preventDefault();
        btn = $(this);
        btn.prop('disabled', true);
        id_lookbook = $(this).closest('.products').attr('id-lookbook');
        row = $(this).closest('.product');
        id_product = row.attr('id-product');
        duration = row.find('.duration').val();
        $.ajax({
            type: 'post',
            url: $('#ajax_url').val(),
            data: {
                'action': 'updateProduct',
                'id_lookbook': id_lookbook,
                'id_product': id_product,
                'duration': duration,
                'secure_key': $('#secure_key').val(),
            },
            success: function (result) {
                rs = JSON.parse(result);
                if (rs.success) {
                } else {
                    alert(rs.err);
                }
                btn.prop('disabled', false);
            }
        })
    })
});
