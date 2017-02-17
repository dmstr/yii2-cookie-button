<?php
/**
 * @link http://diemeisterei.de
 * @copyright Copyright (c) 2014 diemeisterei GmbH
 * @license https://github.com/dmstr/yii2-cookie-button/LICENSE.md
 * @author Marc Mautz <marc@diemeisterei.de>
 */

namespace dmstr\cookiebutton;

use yii\web\AssetBundle as AssetBundle;

/**
 * This declares the asset files required by the CookieButton.
 *
 * @author Marc Mautz <marc@diemeisterei.de>
 * @since 2.0
 */
class CookieButtonAsset extends AssetBundle
{
    /**
     * @inheritdoc
     * @var string the source path to the asset files.
     * In case you have asset files under a non web accessible directory,
     * that is the case for any extension, you need to specify $sourcePath instead of $basePath and $baseUrl.
     */
    public $sourcePath = '@dmstr/cookiebutton/assets/';

    /**
     * @inheritdoc
     * @var array list of CSS files that this bundle contains.
     */
    public $css = [];

    /**
     * @inheritdoc
     * @var array list of JavaScript files that this bundle contains.
     */
    public $js = [
        'js/jquery.cookie.js',
        'js/cookie.button.js'
    ];

    /**
     * @inheritdoc
     * @var array dependencies on other asset bundles are specified via $depends property.
     * It is an array that contains fully qualified class names of bundle classes
     * that should be published in order for this bundle to work properly.
     */
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
} 