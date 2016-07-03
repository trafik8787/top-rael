/**
 * Created with JetBrains PhpStorm.
 * User: Vitalik
 * Date: 22.05.14
 * Time: 0:09
 * To change this template use File | Settings | File Templates.
 */

$(document).ready(function(){

    jQuery.validator.addMethod(
        'regexp',
        function(value, element, regexp) {
            var re = new RegExp(regexp);
            return this.optional(element) || re.test(value);
        },
        "Please check your input."
    );

    tinymce.init({
        selector:'.add-editor',
        language : "ru",
        height: '300',
        plugins: [
            "advlist autolink lists link image charmap print preview anchor",
            "searchreplace visualblocks code fullscreen",
            "insertdatetime media table contextmenu paste jbimages"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages",
        relative_urls: false

    });

    $('[data-toggle="tooltip"]').tooltip();
//    input file
    $(document).on('click', '#close-preview', function(){
        $('.image-preview').popover('hide');
        // Hover befor close the preview
        $('.image-preview').hover(
            function () {
                $('.image-preview').popover('show');
            },
            function () {
                $('.image-preview').popover('hide');
            }
        );
    });

    $(function() {
        // Create the close button
        var closebtn = $('<button/>', {
            type:"button",
            text: 'x',
            id: 'close-preview',
            style: 'font-size: initial;'
        });
        closebtn.attr("class","close pull-right");
        // Set the popover default content
        $('.image-preview').popover({
            trigger:'manual',
            html:true,
            title: "<strong>Preview</strong>"+$(closebtn)[0].outerHTML,
            content: "There's no image",
            placement:'bottom'
        });
        // Clear event
        $('.image-preview-clear').click(function(){
            $('.image-preview').attr("data-content","").popover('hide');
            $('.image-preview-filename').val("");
            $('.image-preview-clear').hide();
            $('.image-preview-input input:file').val("");
            $(".image-preview-input-title").text("Browse");
        });
        // Create the preview image
        $(".image-preview-input input:file").change(function (){
            var img = $('<img/>', {
                id: 'dynamic',
                width:250,
                height:200
            });
            var file = this.files[0];
            var reader = new FileReader();
            // Set preview image into the popover data-content
            reader.onload = function (e) {
                $(".image-preview-input-title").text("Change");
                $(".image-preview-clear").show();
                $(".image-preview-filename").val(file.name);
                img.attr('src', e.target.result);
                $(".image-preview").attr("data-content",$(img)[0].outerHTML).popover("show");
            }
            reader.readAsDataURL(file);
        });
    });


    $(document).on('click', '.btn-add', function(e)
    {


        e.preventDefault();

        var controlForm = $(this).parents('.w-input-form'),
            currentEntry = $(this).parents('.entry:first'),
            newEntry = $(currentEntry.clone()).appendTo(controlForm);

        newEntry.find('input').val('');
        controlForm.find('.entry:not(:last) .btn-add')
            .removeClass('btn-add').addClass('btn-remove')
            .removeClass('btn-success').addClass('btn-danger')
            .html('<span class="glyphicon glyphicon-minus" style="padding: 3px"></span>');

        var wit = newEntry.find('.chosen-container-single').width();
        //console.log(wit);
        newEntry.find('.chosen-container-single').detach('.chosen-container-single');
        $(".chosen-select").chosen({
            allow_single_deselect: true
        });
        newEntry.find('.chosen-container-single').css('width', wit+'px');


    }).on('click', '.btn-remove', function(e)
        {
            $(this).parents('.entry:first').remove();

            e.preventDefault();
            return false;
        });

// end input file


    //удалить файлы
    $(document).on('click', '.w-delete', function(){
        $(this).parents('tr').detach();
        return false
    });


    $(".chosen-select").chosen({
        allow_single_deselect: true
        //width: "30%"
    });

    //$('.form_date').datetimepicker({
    //    language: 'ru',
    //    weekStart: 1,
    //    todayBtn:  1,
    //    autoclose: 1,
    //    todayHighlight: 1,
    //    startView: 2,
    //    minView: 2,
    //    forceParse: 0
    //});

    //$('.form_time').datetimepicker({
    //    language: 'ru',
    //    weekStart: 1,
    //    todayBtn:  1,
    //    autoclose: 1,
    //    todayHighlight: 1,
    //    startView: 1,
    //    minView: 0,
    //    maxView: 1,
    //    forceParse: 0
    //});
    //
    //$('.form_datetime').datetimepicker({
    //    language: 'ru',
    //    weekStart: 1,
    //    todayBtn:  1,
    //    autoclose: 1,
    //    todayHighlight: 1,
    //    startView: 2,
    //    forceParse: 0,
    //    showMeridian: 1
    //});










    $(document).on('click', '.demo .w-calendar-bus', function(){
        $('input[name="daterange"]').trigger('click');
    });

    $(document).on('click', '.demo .w-calendar-article', function(){
        $('input[name="daterange_article"]').trigger('click');
    });


    $(document).on('click', '.demo .w-calendar-coupons', function(){
        $('input[name="daterange_coupons"]').trigger('click');
    });


    $(document).on('click', '.demo .w-calendar-baners', function(){
        $('input[name="daterange_baners"]').trigger('click');
    });




    $('input[name="daterange"]').daterangepicker({
        //"timePickerIncrement": 43200,
        locale: {
            format: 'DD/MM/YYYY'
        },
        "alwaysShowCalendars": true,
        "startDate": get_date(null, 30),
        "endDate": formatDate()
    }, function(start, end, label) {
        console.log("New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')");
    });




    $('input[name="daterange_article"]').daterangepicker({
        //"timePickerIncrement": 43200,
        locale: {
            format: 'DD/MM/YYYY'
        },
        "alwaysShowCalendars": true,
        "startDate": get_date(null, 30),
        "endDate": formatDate()
    }, function(start, end, label) {
//                console.log("New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')");
    });


    $('input[name="daterange_coupons"]').daterangepicker({
        //"timePickerIncrement": 43200,
        locale: {
            format: 'DD/MM/YYYY'
        },
        "alwaysShowCalendars": true,
        "startDate": get_date(null, 30),
        "endDate": formatDate()
    }, function(start, end, label) {
//                console.log("New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')");
    });


    $('input[name="daterange_baners"]').daterangepicker({
        //"timePickerIncrement": 43200,
        locale: {
            format: 'DD/MM/YYYY'
        },
        "alwaysShowCalendars": true,
        "startDate": get_date(null, 30),
        "endDate": formatDate()
    }, function(start, end, label) {
//                console.log("New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')");
    });



    $('#table-bus, #table-article, #table-coupons, #table-baners').DataTable({
        "pagingType": "full_numbers",
        "order": [[ 2, "desc" ]],
        "pageLength": 50,
        "oLanguage": {
            "sZeroRecords": "Нет записей",
            "sInfo": "Показано _START_ из _END_ всего _TOTAL_ записей",
            "sLengthMenu": "Показать _MENU_ записей",
            "sSearch": "Поиск",
            "sInfoEmpty": "Нет записей для отображения",

            "oPaginate": {
                "sNext": "Вперед",
                "sLast": "Конец",
                "sFirst": "Начало",
                "sPrevious": "Назад"

            }
        }

    });



    function get_date(data, day)
    {
        if (data == null) {
            data = formatDate();
        }

        data = data.split('/');
        data = new Date(data[2], +data[1]-1, +data[0]-day, 0, 0, 0, 0);
        data = [data.getDate(),data.getMonth()+1,data.getFullYear()];
        data = data.join('/').replace(/(^|\/)(\d)(?=\/)/g,"$10$2");
        return data
    }


    function formatDate() {

        date = new Date();
        var dd = date.getDate();
        if (dd < 10) dd = '0' + dd;

        var mm = date.getMonth() + 1;
        if (mm < 10) mm = '0' + mm;

        var yy = date.getFullYear();
        if (yy < 10) yy = '0' + yy;

        return dd + '/' + mm + '/' + yy;
    }









});