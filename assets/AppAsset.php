<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
		'https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700,700i&amp;subset=cyrillic',
		'css/main.css',
		'css/site.css',
    ];

    public $js = [
		//'js/vendor/jquery.min.js',
        'js/vendor/jquery.elevatezoom.js',
        'js/vendor/headroom.min.js',
        'js/vendor/rellax.min.js',
        'js/vendor/scrollreveal.min.js',
        'js/vendor/slideout.min.js',
        'js/vendor/jquery.magnific-popup.min.js',
		'js/vendor/swiper.jquery.min.js',
		'js/vendor/scrollIt.min.js',
		'js/main.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];
}
