<?php
/**
 * @link http://diemeisterei.de
 * @copyright Copyright (c) 2014 diemeisterei GmbH
 * @license https://github.com/dmstr/yii2-cookie-button/LICENSE.md
 * @author Marc Mautz <marc@diemeisterei.de>
 */

namespace dmstr\cookiebutton;

use yii\web\AssetBundle as AssetBundle;

class CookieButtonAsset extends AssetBundle
{
    //public $basePath = '@webroot';
    //public $baseUrl = '@web';
    public $sourcePath = '@dmstr/cookiebutton/assets/';

    public $css = [];

    public $js = [
        'js/jquery.cookie.js',
        'js/cookie.button.js'
    ];

    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
} 