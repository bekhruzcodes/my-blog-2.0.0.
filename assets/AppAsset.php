<?php
/**
 * @link https://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license https://www.yiiframework.com/license/
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
        'css/site.css',
        'css/styles.css',
        'css/vendor.css',
    ];
    public $js = [
        'js/jquery-3.2.1.min.js',
        'js/main.js',
        'js/modernizr.js',
        'js/plugins.js',
        'js/imagesloaded.pkgd.min.js',
        'js/subscribe.js',
    ];
    public $depends = [

    ];
}
