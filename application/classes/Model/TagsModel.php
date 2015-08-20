<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 20.08.2015
 * Time: 16:28
 */

class Model_TagsModel extends Model_BaseModel {

    /**
     * @return mixed
     * получить весь список тегов
     */
    public function getAllTags(){
        return DB::select()
            ->from('tags')
            ->cached()
            ->execute()->as_array();
    }


}