<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */
namespace backend\assets;

use yii\web\AssetBundle;

class EzAsset extends AssetBundle
{
    // public $basePath = '@webroot';
    public $sourcePath = '@npm/ez-plus';
    public $baseUrl = '@web';
    public $css = [
        'css/jquery.ez-plus.css',
    ];
    public $js = [
        'src/jquery.ez-plus.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
