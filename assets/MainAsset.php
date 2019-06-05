<?php
namespace app\assets;


use yii\web\AssetBundle;

class MainAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        "https://fonts.googleapis.com/css?family=Titillium+Web:200,200i,300,300i,400,400i,600,600i,700,700i,900",
        "https://fonts.googleapis.com/css?family=Fira+Mono:400,500,700&amp;subset=latin-ext",
        "https://cdnjs.cloudflare.com/ajax/libs/fullPage.js/3.0.5/fullpage.min.css",
        "https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css",
        "css/home.css",
        "css/home-media.css"
    ];
    public $js = [

        "https://cdnjs.cloudflare.com/ajax/libs/fullPage.js/3.0.5/vendors/scrolloverflow.min.js",
        "https://cdnjs.cloudflare.com/ajax/libs/fullPage.js/3.0.5/fullpage.extensions.min.js",
        "https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js",
//        "js/scroll.js", - записали условие в шаблоне.
        "js/home.js",
        "js/ajax.js"

    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
?>