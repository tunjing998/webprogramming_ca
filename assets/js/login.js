$(document).ready(function () {


    //esc key to close modal
    $(document).on("keyup", function (event) {
        if (event.keyCode === 27) {
            $("#log").hide();
        }
    });

    //press anywhere to close the modal
    $(document).click(function (evt) {
        if ($(evt.target).is(".modal")) {
            $(".modal").hide();
        }
    });

    $('#showpassword').on('mousedown', function () {
        var passwordField = $('#password');
        passwordField.attr('type', 'text');
    }).on('mouseup mouseleave', function () {
        var passwordField = $('#password');
        passwordField.attr('type', 'password');
    });

    $('#btn').on('click', () => {
        var input = $('#input').val();
        var password = $('#password').val();
        if (!(input == '' || password == '')) {
            $.ajax(
                {
                    url: '/wp_ca4_tunjingAng_xingnuoCen_emiliaCzubaj/assets/api/checkUsername.php',
                    type: 'post',
                    data:
                    {
                        username: input,
                        password: password,
                        action: 'login'
                    },
                    success: function (response) {
                        if (response != '-1') {
                            // $.post("/wp_ca4_tunjingAng_xingnuoCen_emiliaCzubaj/login", {
                            //     id: response
                            // })
                            // window.location.href = "/wp_ca4_tunjingAng_xingnuoCen_emiliaCzubaj/login";

                            // alert(":LOGIN SUCCESS!");

                            var url = '/wp_ca4_tunjingAng_xingnuoCen_emiliaCzubaj/login';
                            var form = $('<form action="' + url + '" method="post">' +
                                '<input type="text" name="id" value=' + response + ' />' +
                                '</form>');
                            $('body').append(form);
                            form.submit();
                        }
                        else {
                            alert(":LOGIN FAILED!");
                        }
                    },
                    error:
                        function () {
                            alert(":AJAX failed!");
                        }
                }
            );
        }
        else {
            alert('Please input username and password');
        }

    });
});
