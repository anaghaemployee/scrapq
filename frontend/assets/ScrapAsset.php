<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class ScrapAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    	/* 'css/site.css', */
        'v1/css/animate.css',
    	'v1/css/flaticon.css',
    	'v1/css/bootstrap.min.css',
    	'v1/css/jquery-ui.min.css',
    	'v1/css/font-awesome.min.css',
    	'v1/css/owl.carousel.min.css',
    	'v1/css/slicknav.min.css',
    	'v1/css/style.css',
    ];
    public $js = [
    	/* 'v1/js/jquery-1.11.1.min.js', */
    	'v1/js/bootstrap.min.js',
    	//'v1/js/jquery-3.2.1.min.js',
    	'v1/js/jquery-ui.min.js',
    	'v1/js/jquery.nicescroll.min.js',
    	'v1/js/jquery.slicknav.min.js',
    	'v1/js/jquery.zoom.min.js',
    	'v1/js/main.js',
    	'v1/js/map.js',
    	'v1/js/owl.carousel.min.js',
    	
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
