<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class UserAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
//        'css/animate.min.css',
//        'css/hamburgers.min.css',
        'css/jquery.fancybox.min.css',//+
        'css/main.css',//+
        'css/media.css',//+
//        'css/smart-grid.css',
        'https://fonts.googleapis.com/css?family=Titillium+Web:200,200i,300,300i,400,400i,600,600i,700,700i,900',//+
    ];
    public $js = [
        'js/canvasjs.min.js',
//        'js/Chart.js',
        'https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js',//+
        'js/chartjs-plugin-stacked100.js',//+
//        'js/EJSChart.min.js',
//        'js/index.js',
        'js/jquery.fancybox.min.js',//+
        'js/main.js',
//        'js/wow.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
    ];
}
