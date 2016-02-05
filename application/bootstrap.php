<?php defined('SYSPATH') or die('No direct script access.');

// -- Environment setup --------------------------------------------------------

// Load the core Kohana class
require SYSPATH.'classes/Kohana/Core'.EXT;

if (is_file(APPPATH.'classes/Kohana'.EXT))
{
	// Application extends the core
	require APPPATH.'classes/Kohana'.EXT;
}
else
{
	// Load empty core extension
	require SYSPATH.'classes/Kohana'.EXT;
}

/**
 * Set the default time zone.
 *
 * @link http://kohanaframework.org/guide/using.configuration
 * @link http://www.php.net/manual/timezones
 */
date_default_timezone_set('America/Chicago');

/**
 * Set the default locale.
 *
 * @link http://kohanaframework.org/guide/using.configuration
 * @link http://www.php.net/manual/function.setlocale
 */
setlocale(LC_ALL, 'en_US.utf-8');

/**
 * Enable the Kohana auto-loader.
 *
 * @link http://kohanaframework.org/guide/using.autoloading
 * @link http://www.php.net/manual/function.spl-autoload-register
 */
spl_autoload_register(array('Kohana', 'auto_load'));

/**
 * Optionally, you can enable a compatibility auto-loader for use with
 * older modules that have not been updated for PSR-0.
 *
 * It is recommended to not enable this unless absolutely necessary.
 */
//spl_autoload_register(array('Kohana', 'auto_load_lowercase'));

/**
 * Enable the Kohana auto-loader for unserialization.
 *
 * @link http://www.php.net/manual/function.spl-autoload-call
 * @link http://www.php.net/manual/var.configuration#unserialize-callback-func
 */
ini_set('unserialize_callback_func', 'spl_autoload_call');

/**
 * Set the mb_substitute_character to "none"
 *
 * @link http://www.php.net/manual/function.mb-substitute-character.php
 */
mb_substitute_character('none');

// -- Configuration and initialization -----------------------------------------

/**
 * Set the default language
 */
I18n::lang('en-us');

if (isset($_SERVER['SERVER_PROTOCOL']))
{
	// Replace the default protocol.
	HTTP::$protocol = $_SERVER['SERVER_PROTOCOL'];
}

/**
 * Set Kohana::$environment if a 'KOHANA_ENV' environment variable has been supplied.
 *
 * Note: If you supply an invalid environment name, a PHP warning will be thrown
 * saying "Couldn't find constant Kohana::<INVALID_ENV_NAME>"
 */
if (isset($_SERVER['KOHANA_ENV']))
{
	Kohana::$environment = constant('Kohana::'.strtoupper($_SERVER['KOHANA_ENV']));

}

/**
 * Initialize Kohana, setting the default options.
 *
 * The following options are available:
 *
 * - string   base_url    path, and optionally domain, of your application   NULL
 * - string   index_file  name of your index file, usually "index.php"       index.php
 * - string   charset     internal character set used for input and output   utf-8
 * - string   cache_dir   set the internal cache directory                   APPPATH/cache
 * - integer  cache_life  lifetime, in seconds, of items cached              60
 * - boolean  errors      enable or disable error handling                   TRUE
 * - boolean  profile     enable or disable internal profiling               TRUE
 * - boolean  caching     enable or disable internal caching                 FALSE
 * - boolean  expose      set the X-Powered-By header                        FALSE
 */
Kohana::init(array(
	'base_url'   => '/',
    'index_file' => FALSE
));

/**
 * Attach the file write to logging. Multiple writers are supported.
 */
Kohana::$log->attach(new Log_File(APPPATH.'logs'));

/**
 * Attach a file reader to config. Multiple readers are supported.
 */
Kohana::$config->attach(new Config_File);

/**
 * Enable modules. Modules are referenced by a relative or absolute path.
 */
Kohana::modules(array(
	 'auth'       => MODPATH.'auth',       // Basic authentication
	 'cache'      => MODPATH.'cache',      // Caching with multiple backends
	// 'codebench'  => MODPATH.'codebench',  // Benchmarking tool
	 'database'   => MODPATH.'database',   // Database access
	'image'      => MODPATH.'image',      // Image manipulation
    'crud'    => MODPATH.'crud',
    'captcha'  => MODPATH.'captcha',
    'pagination' => MODPATH.'pagination',
    'email'	  => MODPATH.'email',
    'ulogin'	  => MODPATH.'ulogin',
	// 'minion'     => MODPATH.'minion',     // CLI Tasks
	 'orm'        => MODPATH.'orm',        // Object Relationship Mapping
	// 'unittest'   => MODPATH.'unittest',   // Unit testing
	// 'userguide'  => MODPATH.'userguide',  // User guide and API documentation
	));

/**
 * Cookie Salt
 * @see  http://kohanaframework.org/3.3/guide/kohana/cookies
 * 
 * If you have not defined a cookie salt in your Cookie class then
 * uncomment the line below and define a preferrably long salt.
 */
 Cookie::$salt = 'sdfg5sd6fg4sd6fgad6fga64g';

/**
 * Set the routes. Each route must have a minimum of a name, a URI and a set of
 * defaults for the URI.
 */

Route::set('GroupBookings', 'group_bookings')
    ->defaults(array(
        'directory' => 'Pages',
        'controller' => 'GroupBookings',
        'action'     => 'index',
    ));

Route::set('Jornal', 'jornal')
    ->defaults(array(
        'directory' => 'Pages',
        'controller' => 'Jornal',
        'action'     => 'index',
    ));

//поиск
Route::set('Search', 'search')
    ->defaults(array(
        'directory' => 'Pages',
        'controller' => 'Search',
        'action'     => 'index',
    ));

//карта сайта
Route::set('Sitemap', 'map')
    ->defaults(array(
        'directory' => 'Pages',
        'controller' => 'Sitemap',
        'action'     => 'index',
    ));


//запись кликов по банерам
Route::set('SetBaners', 'set_baners')
    ->defaults(array(
        'directory' => 'Pages',
        'controller' => 'Ajax',
        'action'     => 'SetBaners',
    ));

//запросы из админки бизнесов на проверку существования урла для валидации
Route::set('checUrlArticles', 'chec_url_articles')
    ->defaults(array(
        'directory' => 'Pages',
        'controller' => 'Ajax',
        'action'     => 'checUrlArticles',
    ));

//запросы из админки бизнесов на проверку существования урла для валидации
Route::set('checUrlBusiness', 'chec_url_bus')
    ->defaults(array(
        'directory' => 'Pages',
        'controller' => 'Ajax',
        'action'     => 'checUrlBusiness',
    ));


//включение и отключение подписки и параметров
Route::set('subscribeEnable', 'subscribe_enable')
    ->defaults(array(
        'directory' => 'Pages',
        'controller' => 'Ajax',
        'action'     => 'subscribeEnable',
    ));

//архив лотареи
Route::set('ArhivLotery', 'arhiv_lotery')
    ->defaults(array(
        'directory' => 'Pages',
        'controller' => 'ArhivLotery',
        'action'     => 'index',
    ));

//профиль владельца бизнеса
Route::set('AccountBusiness', 'account_business')
    ->defaults(array(
        'directory' => 'Pages',
        'controller' => 'AccountBusiness',
        'action'     => 'index',
    ));

//подтверждение подписки
Route::set('Susses_subscribe', 'susses_subscribe')
    ->defaults(array(
        'directory' => 'Pages',
        'controller' => 'Subscribe',
        'action'     => 'SussesSubscribe',
    ));

//отписатся от рассылки
Route::set('Unsubscribe', 'unsubscribe')
    ->defaults(array(
        'directory' => 'Pages',
        'controller' => 'Subscribe',
        'action'     => 'Unsubscribe',
    ));

//запускается по крону и сравнивает даты если до даты окончания бизнеса остается 7 дней
Route::set('BussinesDisableEmailSevenDays', 'sendbusiness')
    ->defaults(array(
        'directory' => 'Pages',
        'controller' => 'Ajax',
        'action'     => 'BussinesDisableEmailSevenDays',
    ));


Route::set('Partners', 'partners')
    ->defaults(array(
        'directory' => 'Pages',
        'controller' => 'Partners',
        'action'     => 'index',
    ));

Route::set('Informers', 'informers')
    ->defaults(array(
        'directory' => 'Pages',
        'controller' => 'Informers',
        'action'     => 'index',
    ));

//архив рассылок
Route::set('ArhivSubscribe', 'newsletter(/<id>)')
    ->defaults(array(
        'directory' => 'Pages',
        'controller' => 'ArhivSubscribe',
        'action'     => 'index',
    ));

Route::set('Feed', 'feed(/<action>)')
    ->defaults(array(
        'controller' => 'Feed',
        'action'     => 'index',
    ));

//добавить купон в избранное
Route::set('ModalCouponSave', 'couponsave')
    ->defaults(array(
        'controller' => 'ModalCoupon',
        'action'     => 'saveFovarites',
    ));

Route::set('ModalCouponDel', 'coupondelete')
    ->defaults(array(
        'controller' => 'ModalCoupon',
        'action'     => 'deleteFovarites',
    ));

//контроллер для избранного бизнесов
Route::set('ModalBussinesSave', 'bussinessave')
    ->defaults(array(
        'controller' => 'ModalBussines',
        'action'     => 'saveFovarites',
    ));
//удалить бизнес из избранного
Route::set('ModalBussinesDel', 'bussinesdel')
    ->defaults(array(
        'controller' => 'ModalBussines',
        'action'     => 'deleteFovarites',
    ));

//сохранить в избранное статью
Route::set('ArticleFavoritAdd', 'articlesave')
    ->defaults(array(
        'controller' => 'ArticleFavorit',
        'action'     => 'saveArticleFavorit',
    ));

//удалить статью из избранного
Route::set('ArticleFavoritDel', 'articledel')
    ->defaults(array(
        'controller' => 'ArticleFavorit',
        'action'     => 'deleteArticleFavorit',
    ));

Route::set('ModalCoupon', 'modalcoupon(/<id_coupon>)')
    ->defaults(array(
        'controller' => 'ModalCoupon',
        'action'     => 'index',
    ));


Route::set('Rss', 'rss(/<action>)')
    ->defaults(array(
        'directory' => 'Pages',
        'controller' => 'Rss',
        'action'     => 'index',
    ));

Route::set('Maps', 'maps')
    ->defaults(array(
        'directory' => 'Pages',
        'controller' => 'Maps',
        'action'     => 'index',
    ));


Route::set('About', 'about')
    ->defaults(array(
        'directory' => 'Pages',
        'controller' => 'About',
        'action'     => 'index',
    ));

//Ajax запросы с главной страницы
Route::set('HomeAjax', 'ajaxselect(/<action>)')
    ->defaults(array(
        'controller' => 'HomeAjax',
        'action'     => 'index',
    ));



// регистрация вход востановление пароля
Route::set('Account', 'account(/<action>)')
    ->defaults(array(
        'directory' => 'Pages',
        'controller' => 'Account',
        'action'     => 'index',
    ));

Route::set('Contacts', 'contacts')
    ->defaults(array(
        'directory' => 'Pages',
        'controller' => 'Contacts',
        'action'     => 'index',
    ));
//подписка
Route::set('Subscribe', 'subscribe')
    ->defaults(array(
        'directory' => 'Pages',
        'controller' => 'Ajax',
        'action'     => 'index',
    ));
//сортировка по категориям БИЗНЕСОВ группы лакшери (теги)
Route::set('TagsCategoryBusiness', 'tagscatselest')
    ->defaults(array(
        'directory' => 'Pages',
        'controller' => 'Ajax',
        'action'     => 'tagscatselest',
    ));

//сортировка по разделам СТАТЬИ группы лакшери (теги)
Route::set('TagsSectionArticles', 'tagsecartic')
    ->defaults(array(
        'directory' => 'Pages',
        'controller' => 'Ajax',
        'action'     => 'tagsecartic',
    ));

//сортировка по разделам КУПОНЫ группы лакшери (теги)
Route::set('TagsSectionCoupns', 'tagseccoupon')
    ->defaults(array(
        'directory' => 'Pages',
        'controller' => 'Ajax',
        'action'     => 'tagseccoupon',
    ));

Route::set('Top_meny', 'city(/<url_city>)')
    ->defaults(array(
        'directory' => 'Pages',
        'controller' => 'City',
        'action'     => 'index',
    ));

Route::set('Tags', 'tags(/<url_tags>)')
    ->defaults(array(
        'directory' => 'Pages',
        'controller' => 'Tags',
        'action'     => 'index',
    ));

Route::set('Maps', 'maps')
    ->defaults(array(
        'directory' => 'Pages',
        'controller' => 'Maps',
        'action'     => 'index',
    ));

Route::set('ArticleNode', 'article(/<url_article>)', array('page' => '[0-9]+'))
    ->defaults(array(
        'directory' => 'Pages',
        'controller' => 'Articles',
        'action'     => 'article',
    ));

Route::set('Articles', 'articles(/<page>)', array('page' => '[0-9]+'))
    ->defaults(array(
        'directory' => 'Pages',
        'controller' => 'Articles',
        'action'     => 'index',
    ));

Route::set('ArticlesSection', 'articles(/<url_section>(/<page>))', array('page' => '[0-9]+'))
    ->defaults(array(
        'directory' => 'Pages',
        'controller' => 'Articles',
        'action'     => 'index',
    ));


Route::set('Business', 'business(/<url_business>)')
    ->defaults(array(
        'directory' => 'Pages',
        'controller' => 'Business',
        'action'     => 'index',
    ));

//открыть страницу купона
Route::set('CouponNode', 'coupon(/<url_coupon>)', array('page' => '[0-9]+'))
    ->defaults(array(
        'controller' => 'ModalCoupon',
        'action'     => 'coupon',
    ));

Route::set('Coupons', 'coupons(/<page>)', array('page' => '[0-9]+'))
    ->defaults(array(
        'directory' => 'Pages',
        'controller' => 'Coupons',
        'action'     => 'index',
    ));

Route::set('CouponsSection', 'coupons(/<url_section>(/<page>))', array('page' => '[0-9]+'))
    ->defaults(array(
        'directory' => 'Pages',
        'controller' => 'Coupons',
        'action'     => 'index',
    ));


Route::set('SectionsPage', 'section(/<url_section>(/<page>))', array('page' => '[0-9]+'))
    ->defaults(array(
        'directory' => 'Pages',
        'controller' => 'Sections',
        'action'     => 'index',
    ));

Route::set('Sections', 'section(/<url_section>(/<url_category>(/<page>)))', array('page' => '[0-9]+'))
    ->defaults(array(
        'directory' => 'Pages',
        'controller' => 'Sections',
        'action'     => 'index',
    ));

Route::set('LogsAdmin', 'administrator/logs(/<page>)', array('page' => '[0-9]+'))
    ->defaults(array(
        'controller' => 'Administrator',
        'action'     => 'logs',
    ));

Route::set('default', '(<controller>(/<action>(/<id>)))')
    ->defaults(array(
        'controller' => 'Home',
        'action'     => 'index',
    ));