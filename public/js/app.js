/**
 * Created by Vitalik on 16.07.2015.
 */
$(document).ready(function(){

    $(document).on('change', '.w-select-city', function(){
        $('#w-form-city').submit();
        //console.log($('#section').val());
        //$.ajax({
        //    type: "POST",
        //    url: "/filtr/city",
        //    data: "id_city="+$(this).val()+"&section="+$('#section').val()+"&category="+$('#category').val(),
        //    success: function(msg){
        //        alert( "Прибыли данные: " + msg );
        //        $('.w-business-list').html(msg);
        //    }
        //});
    });

});