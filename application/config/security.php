<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 26.07.2015
 * Time: 22:41
 */

return array(
    # Order
    'Controller_Administrator' => array(
        'bussines'           => array('admin', 'manager'),
        'coupons'           => array('admin', 'manager'),
        'galery'           => array('admin', 'manager'),
        'articles'           => array('admin', 'redactor'),
        'lotarey'           => array('admin', 'manager'),
        'contacts'           => array('admin', 'manager'),
        'subscription'           => array('admin'),
        'users'           => array('admin'),
        'sections'           => array('admin'),
        'category'           => array('admin'),
        'tags'           => array('admin'),
        'banners'           => array('admin'),
        'about'           => array('admin'),

        'welcome'           => array('admin', 'redactor', 'manager'),
        'index'           => array('admin'),
        'login'           => array('admin', 'redactor', 'manager'),
        'logout'           => array('admin', 'redactor', 'manager'),
    )
);