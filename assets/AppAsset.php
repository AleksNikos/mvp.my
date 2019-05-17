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
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        /*исходные файлы*/
        'css/site.css',

        /*Шаблонные файлы*/
        'css/animate.min.css',
        'css/hamburgers.min.css',
        'css/jquery.fancybox.min.css',
        'css/main.css',
        'css/media.css',
        'css/smart-grid.css'
    ];
    public $js = [

        /*Шаблонные файлы*/

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
