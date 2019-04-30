$(document).ready(function () {

    $('#type1,#type2,#type3,#type4,#priceInputMax,#priceInputMin').on('click', function () {
        var type = $(this).html();
        console.log(type);
        if (type == 'All') {
            type = '';
        }
        var priceLow = $('#priceMin').html();
        var priceHigh = $('#priceMax').html();

        $.ajax(
            {
                url: '/wp_ca4_tunjingAng_xingnuoCen_emiliaCzubaj/assets/api/productFilter.php',
                type: 'post',
                data:
                {
                    type: type,
                    price_low: priceLow,
                    price_high: priceHigh
                },
                success: function (response) {
                    var result = JSON.parse(response);
                    var body = $('#products').html('');
                    if (result.length != 0) {
                        result.forEach(element => {
                            body.append(`
                <div class="col-3 m-3 shadow bg-black border rounded product-item">
                        <img src="/wp_ca4_tunjingAng_xingnuoCen_emiliaCzubaj/assets/img/productImg/${element.product_img_address}" width="250px" height="250px">
                        <p>Name  : <?= ${element.product_name} ?></p>
                        <p>Price : <?= ${element.product_price} ?></p>
                        <a href='/wp_ca4_tunjingAng_xingnuoCen_emiliaCzubaj/product/${element.product_id}'>More Details </a>
                    </div>
               
                     `);
                        });
                    } else {
                        body.append(`
                        <div class='container col-6'>
                        <p>No Result Found</p>
                        </div>`
                        )
                    }
                },
                error:
                    function () {
                        alert(":AJAX failed!");
                    }
            }
        );
    });

    var slider = document.getElementById("priceInputMin");
    var output = document.getElementById("priceMin");
    output.innerHTML = slider.value; // Display the default slider value

    // Update the current slider value (each time you drag the slider handle)
    slider.oninput = function () {
        output.innerHTML = this.value;
    }
    var slider2 = document.getElementById("priceInputMax");
    var output2 = document.getElementById("priceMax");
    output2.innerHTML = slider2.value; // Display the default slider value

    // Update the current slider value (each time you drag the slider handle)
    slider2.oninput = function () {
        output2.innerHTML = this.value;
    }
});
