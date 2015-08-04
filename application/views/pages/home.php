<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 03.08.2015
 * Time: 18:05
 */

?>
<style>
    .w-active-cat {
        background-color: aqua;
    }
</style>

<script>
    $(document).ready(function(){



        $(document).on('click', '.w-home-cat', function(){

            var thises = $(this);
            var sliderTmp = thises.closest('.w-bloc-section').find('.slider');
            var selectTmp = thises.closest('.w-bloc-section').find('.w-select-city');
            var remowClas = thises.parents('.w-category-bloc').find('a.w-active-cat');

            //удаляем клас
            remowClas.removeClass('w-active-cat');
            //добавляем класс
            thises.addClass('w-active-cat');


            $.ajax({ // описываем наш запрос
                type: "POST", // будем передавать данные через POST
                dataType: "JSON", // указываем, что нам вернется JSON
                url: '/ajaxselect',
                data: 'section='+$(this).data('section')+'&cat='+$(this).data('cat'), // передаем данные из формы
                success: function(response) { // когда получаем ответ


                    sliderTmp.empty();

                    //console.log(response);
                    $.each(response.data, function(index, value) {
                        console.log(value);
                        sliderTmp.append('<div class="col-md-4">'+
                        '<div class="thumbnail">'+
                        '<a href="#" class="pin"><i class="fa fa-star"></i></a>'+
                        '<a href="#" class="thumbnail-image"> <img src="" width="240" height="150" alt="dfgfg"> </a>'+
                        '<div class="caption"> <h3><a href="#">'+value.name+'</a>'+
                        '</h3><em>'+value.CityName+' '+ value.address+'</em>'+
                        value.info+
                        '</div></div></div>');

                    });

                    var options='<option value="">По городам</option>';
                    $.each(response.city, function(index, value) {
                        //console.log(value);
                        selectTmp.empty();
                        options += '<option value="'+index+'">' + value + '</option>';
                    });
                    selectTmp.html(options);

                }
            });


            return false;
        });


        $(document).on('change', '.w-select-city', function(){

            var thisSel = $(this);
            var sliderTmp = thisSel.closest('.w-bloc-section').find('.slider');
            //console.log($(this).val());
            $.ajax({ // описываем наш запрос
                type: "POST", // будем передавать данные через POST
                dataType: "JSON", // указываем, что нам вернется JSON
                url: '/ajaxselect',
                data: 'city='+$(this).val()+'&section='+$('.w-active-cat').data('section')+'&cat='+$('.w-active-cat').data('cat'), // передаем данные из формы
                success: function(response) { // когда получаем ответ
                    //очищаем слайдер
                    sliderTmp.empty();
                    $.each(response.data, function(index, value) {
                        console.log(value);
                        sliderTmp.append('<div class="col-md-4">'+
                        '<div class="thumbnail">'+
                        '<a href="#" class="pin"><i class="fa fa-star"></i></a>'+
                        '<a href="#" class="thumbnail-image"> <img src="" width="240" height="150" alt="dfgfg"> </a>'+
                        '<div class="caption"> <h3><a href="#">'+value.name+'</a>'+
                        '</h3><em>'+value.CityName+' '+ value.address+'</em>'+
                        value.info+
                        '</div></div></div>');

                    });

                }
            });
        });


    });
</script>
<?//HTML::x($data)?>
<div class="row">
    <div class="col-md-9">

        <?foreach($data as $key => $rowsdata):?>


            <div class="w-bloc-section">
                <div class="w-category-city-bloc">
                    <h2><?=$rowsdata['category'][0]['name']?></h2>

                    <select class="form-control w-select-city" name="city" style="width: 20%">
                        <option value="">По городам</option>
                        <?foreach($rowsdata['city'] as $key_id => $row_city):?>
                            <option value="<?=$key_id?>"><?=$row_city?></option>
                        <?endforeach?>
                    </select>

                    <div class="w-category-bloc">
                        <a href="/section/<?=$rowsdata['category'][0]['url']?>" data-section="<?=$rowsdata['category'][0]['url']?>"  class="w-home-cat w-active-cat" >Все</a>
                        <?foreach($rowsdata['category'][0]['childs'] as $row_category):?>

                            <a href="/section/<?=$rowsdata['category'][0]['url'].'/'.$row_category['url']?>" data-cat="<?=$row_category['url']?>" class="w-home-cat" ><?=$row_category['name']?></a>

                        <?endforeach?>
                    </div>
                </div>

                <div class="row slider">

                    <?foreach ($rowsdata['data'] as $rows):?>

                        <div class="col-md-4">
                            <div class="thumbnail">

                                <a href="#" class="pin">
                                    <i class="fa fa-star"></i>
                                </a>

                                <a href="#" class="thumbnail-image">
                                    <img src="" width="240" height="150" alt="dfgfg">
                                </a>

                                <div class="caption">
                                    <h3><a href="#"><?=$rows['name']?></a></h3>

                                    <em><?=$rows['CityName']?>. <?=$rows['address']?></em>

                                    <?=strip_tags($rows['info'])?>
                                </div>
                            </div>
                        </div>

                    <?endforeach?>

                </div>
            </div>
        <?endforeach?>



    </div>

    <div class="col-md-3">
        прави блок
    </div>

</div>