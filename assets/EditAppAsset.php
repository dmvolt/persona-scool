<?php
/**
 * Created by PhpStorm.
 * User: ÑÒÄ
 * Date: 17.08.2016
 * Time: 16:18
 */
namespace app\assets;
use yii\web\AssetBundle;

class EditAppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
	
    public $css = [
		//'https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700,700i|Rubik+One|Knewave&amp;subset=cyrillic',
		'css/hover-dropdown-menu.css',
		'css/jquery.fancybox.css',
		'css/jquery-ui.css',
		'css/owl.carousel.css',
		'css/owl.theme.default.css',
		'css/font-awesome.min.css',
		'css/iconfont.css',
		'css/themeHover.css',
        'css/style.css',
		'css/responsive.css',
		'css/color.css',
		'css/site.css',
    ];

    public $js = [
		//'js/vendor/jquery.min.js',
        'js/vendor/bootstrap.min.js',
        'js/vendor/hover-dropdown-menu.js',
        'js/vendor/jquery.hover-dropdown-menu-addon.js',
        'js/vendor/owl.carousel.min.js',
        'js/vendor/jquery.fancybox.pack.js',
        'js/vendor/jquery.fancybox-media.js',
		'js/main.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}