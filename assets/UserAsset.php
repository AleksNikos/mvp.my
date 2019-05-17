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
        'https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css',//+
        'css/main.css',//+
        'css/responsive-tables.css',//+
        'css/media.css',//+
        'https://fonts.googleapis.com/css?family=Titillium+Web:200,200i,300,300i,400,400i,600,600i,700,700i,900',//+
    ];
    public $js = [

        'https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js',//+
        'js/chartjs-plugin-stacked100.js',//+
        'js/jquery.fancybox.min.js',//+
        'js/main.js',
        'js/ajax.js',
        'js/responsive-tables.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
