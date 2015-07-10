/**
 * Created by Vitalik on 22.05.2015.
 */
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();


    $(document).on('click', '.close-alert', function(){
        $('.w-alert').hide("fast");
    });


    $(".w-board-vip-form").validate({

        rules:{

            name:{
                required: true,
                minlength: 4,
                maxlength: 16
            },

            tel:{
                required: true,
                maxlength: 20
            },

            email:{
                required: true,
                email: true
            },

            desc:{
                required: true
            }

        },

        messages:{

            name:{
                required: "Это поле обязательно для заполнения",
                minlength: "Имя должно быть минимум 3 символа",
                maxlength: "Максимальное число символо - 16"
            },

            tel:{
                required: "Это поле обязательно для заполнения"

            },

            email:{
                required: "Это поле обязательно для заполнения",
                email: 'Неправельный формат'

            },

            desc:{
                required: "Это поле обязательно для заполнения"

            }

        },
        submitHandler: function(form){

            $('#circularG').show();

            $.ajax({ // описываем наш запрос
                        type: "POST", // будем передавать данные через POST
                        dataType: "JSON", // указываем, что нам вернется JSON
                        url: $('#w-url-contr').val(),
                        data: $('.w-board-vip-form').serialize(), // передаем данные из формы
                        success: function(response) { // когда получаем ответ

                            if (response.susses) {
                                //$('.w-board-vip-form .w-capcha').html(base64_decode(response.captcha));
                                $('.w-board-vip-form').trigger('reset');
                                $('#myModal .modal-content').addClass('w-modal-success');
                                $('#myModal .modal-title').text('Спасибо!');
                                $('#myModal .modal-body').text(response.susses);

                                setTimeout(function () {
                                    $('#circularG').hide();
                                    $('#myModal').modal('show');
                                }, 1000);

                            }

                            if (response.error_captcha) {

                                $('#myModal .modal-content').addClass('w-modal-error');
                                $('#myModal .modal-title').text('Что же такое?! Вы получили ошибку!');
                                $('#myModal .modal-body').text(response.error_captcha);

                                setTimeout(function () {
                                    $('#circularG').hide();
                                    $('#myModal').modal('show');
                                }, 1000);
                            }


                        }
                    });


        }



    });

});
