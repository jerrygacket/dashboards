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
        'css/bootstrap.min.css',
        'css/fontawesome.min.css',
        'css/solid.min.css',
        'css/mdb.min.css',
        'css/chart.min.css',
        'css/style.css',
    ];
    public $js = [
        'js/jquery.min.js',
        'js/popper.min.js',
        'js/bootstrap.min.js',
        'js/mdb.min.js',
        'js/chart.min.js',
//        'js/sender.js',
//        'js/actions.js',
//        'js/main.js',
    ];
    public $depends = [
        //'yii\web\YiiAsset',
        //'yii\bootstrap4\BootstrapAsset',
    ];
}
