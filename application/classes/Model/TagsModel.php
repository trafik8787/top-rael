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
     * todo получить весь список тегов
     */
    public function getAllTags(){
        return DB::select()
            ->from('tags')
            ->cached()
            ->execute()->as_array();
    }


    /**
     * @param $url
     * @return mixed
     * todo получить теги по урлу
     */
    public function getTagsUrl ($url){
        $query =  DB::select()
            ->from('tags')
            ->where('url_tags','=',$url)
            ->cached()
            ->execute()->as_array();

        if (empty($query)){
            $query = false;
        }
        return $query;
    }

}