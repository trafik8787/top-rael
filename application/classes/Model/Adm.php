<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 14.07.2015
 * Time: 23:59
 */

class Model_Adm extends Model {

    public function get_table ($table, $where){
        return DB::select()
            ->from($table)
            ->where($where[0], $where[1], $where[2])
            ->execute()->as_array();
    }


    public function update_galery ($filename = null, $title, $id) {
        if ($filename == null) {
            $query = DB::update('files')
                ->set(array('title' => $title))
                ->where('id', '=', $id)->execute();
        } else {
            $query = DB::update('files')
                ->set(array('filename' => $filename,
                    'title' => $title
                ))
                ->where('id', '=', $id)->execute();
        }

    }

    public function insert_galery ($filename, $title, $gallery_id){
        $query = DB::insert('files', array('filename', 'title', 'gallery'))
            ->values(array($filename, $title, $gallery_id))->execute();
    }


    public function delete_galery ($id){
        $query = DB::delete('files')
            ->where('id', 'IN', $id)->execute();
    }
}