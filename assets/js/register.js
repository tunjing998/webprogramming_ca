$(document).ready(function () {

    $('#usernameRegister').keyup(function () {
        var username = $('#usernameRegister').val();
        if (username != '') {
            $('#availiable').show();

            $.ajax(
                {
                    url: '/wp_ca4_tunjingAng_xingnuoCen_emiliaCzubaj/assets/api/checkUsername.php',
                    type: 'post',
                    data:
                    {
                        username: username,
                        action: 'checkUsername'
                    },
                    success: function (response) {
                        if (response == '0') {
                            $('#availiable').html("<i class='far fa-check-circle'></i>");
                        }
                        else {
                            $('#availiable').html("<i class='fas fa-times-circle'></i>");
                        }
                    },
                    error:
                        function () {
                            alert(0 + ":AJAX failed!");
                        }
                }
            );
        }
        else {
            $("#availiable").hide();
        }

    });
    $('#email').keyup(function () {
        var email = $('#email').val();
        if (email != '') {
            $('#emailAvailiable').show();

            $.ajax(
                {
                    url: '/wp_ca4_tunjingAng_xingnuoCen_emiliaCzubaj/assets/api/checkUsername.php',
                    type: 'post',
                    data:
                    {
                        email: email,
                        action: 'checkEmail'
                    },
                    success: function (response) {
                        if (response == '0') {
                            $('#emailAvailiable').html("<i class='far fa-check-circle'></i>");
                        }
                        else {
                            $('#emailAvailiable').html("<i class='fas fa-times-circle'></i>");
                        }
                    },
                    error:
                        function () {
                            alert(0 + ":AJAX failed!");
                        }
                }
            );
        }
        else {
            $("#emailAvailiable").hide();
        }

    });
    $('#passwordRegister').keyup(function () {
        var passcode = $('#passwordRegister').val();
        if (passcode != '') {
            $('#passwordStrength').show();

            $.ajax(
                {
                    url: '/wp_ca4_tunjingAng_xingnuoCen_emiliaCzubaj/assets/api/checkUsername.php',
                    type: 'post',
                    data:
                    {
                        passcode: passcode,
                        action: 'checkPasswordStrength'
                    },
                    success: function (response) {
                        if (response == '0') {
                            $('#passwordStrength').html("Very Weak");
                        }
                        else if (response == '1'){
                            $('#passwordStrength').html("Weak");
                        }
                        else if (response == '2') {
                            $('#passwordStrength').html("Normal");
                        } else if (response == '3') {
                            $('#passwordStrength').html("Strong");
                        }
                        else if (response == '4') {
                            $('#passwordStrength').html("Very Strong");
                        }
                        else {
                            $('#passwordStrength').html("Error");
                        }

                    },
                    error:
                        function () {
                            alert(0 + ":AJAX failed!");
                        }
                }
            );
        }
        else {
            $("#passwordStrength").hide();
        }

    });
});
