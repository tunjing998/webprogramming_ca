$(document).ready(function () {
    let cart = $('#cartbody');
    $('.item').on('click', function () {
        const id = $(this).val();
        const product_name = $('#product-name' + id).val();
        const product_price = $('#product-price' + id).val();
        var product_quantity = $('#product_quantity' + id).html();
        $.ajax(
            {
                url: "/wp_ca4_tunjingAng_xingnuoCen_emiliaCzubaj/assets/api/cart.php",
                method: "POST",
                data: {
                    product_id: id,
                    product_name: product_name,
                    product_price: product_price,
                    product_quantity: product_quantity,
                    action: 'add'
                },
                success: function (response) {
                    cart.html(response);
                }
            }
        )
    });

    $(document).on('click','.delete', function () {
        var id = $(this).attr("id");
        console.log(id);
        $.ajax(
            {
                url: "/wp_ca4_tunjingAng_xingnuoCen_emiliaCzubaj/assets/api/cart.php",
                method: "POST",
                data: {
                    product_id: id,
                    action: 'delete'
                },
                success: function (response) {
                    cart.html(response);
                }
            }
        )
    });
});