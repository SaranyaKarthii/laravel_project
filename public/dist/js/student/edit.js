$(document).ready(function () {
    $("#student-create-form").validate({
        rules: {
            name: {
                required: true,
            },
            register_no: {
                required: true,
            },
            phone: {
                required: true,
            },
            email: {
                required: true,
                email: true,
            },
            year: {
                required: true,
                number:true,
                min:1,
                max:5
            },
            address_line1: {
                required: true,
            },
            address_line2: {
                required: true,
            },
            city: {
                required: true,
            },
            state: {
                required: true,
            },
            country: {
                required: true,
            },
            pincode: {
                required: true,
                number:true,
                maxlength:6,
                minlength:6
            },
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    });
    $("#student-create-form").submit(function (e) {
        e.preventDefault();
        if ($("#student-create-form").valid()) {
            var form = $(this);
            $.ajax({
                url: BASE_URL + "api/students/update",
                type: 'POST',
                data: form.serialize(),
                beforeSend: function () {
                    $(".text-error").html("");
                    $('#btn-submit').attr("disabled", "disabled");
                },
                success: function (data, textStatus, xhr) {
                    if (xhr.status == 200) {
                        message(data.status, data.message);
                    }
                },
                error: function (reject) {

                },
                complete: function (xhr, textStatus) {
                    var data = JSON.parse(xhr.responseText);
                    if (xhr.status == 422) {
                        message(0, data.message);
                        $.each(data.errors, function (key, value) {
                            $("#" + key + "_error").html(value);
                        });
                    }
                    $('#btn-submit').removeAttr("disabled");
                }
            });
        }
    });

});
