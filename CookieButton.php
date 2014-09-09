<?php
/**
 * @link http://diemeisterei.de
 * @copyright Copyright (c) 2014 diemeisterei GmbH
 * @license https://github.com/dmstr/yii2-cookie-button/LICENSE.md
 * @author Marc Mautz <marc@diemeisterei.de>
 */

namespace dmstr\cookiebutton;

use yii\helpers\Json;
use yii\web\View;
use yii\helpers\Html;
use yii\bootstrap\Button;
use yii\bootstrap\ButtonGroup;
use yii\helpers\ArrayHelper;

/**
 * CookieButton renders a "Twitter Bootstrap" button or buttongroup.
 *
 * For example, a single default button ("Twitter Bootstrap" Button)
 *
 * ~~~
 * echo CookieButton::widget([
 *     'label' => 'Button',                 // String for default button, array for switch buttons
 *     'options' => [
 *          'id' => 'cookieDefaultBtn',     // The button id
 *          'class' => 'btn-xs btn-primary' // Default button class
 *     ],
 *     'cookie' => [
 *          'name' => 'name',
 *          'value' => 'value',
 *          'options' => [                  // 'options' are optional
 *              'expires' => 365,           // Define lifetime of the cookie. Value can be a Number which will be interpreted as days from time of creation or a Date object. If omitted, the cookie becomes a session cookie.
 *              'path' => '/',              // Define the path where the cookie is valid. By default the path of the cookie is the path of the page where the cookie was created (standard browser behavior).
 *              'domain' => 'example.com',  // Define the domain where the cookie is valid. Default: domain of page where the cookie was created.
 *              'secure' => true            // If true, the cookie transmission requires a secure protocol (https). Default: false.
 *          ]
 *      ]
 * ]);
 * ~~~
 *
 * For example, a switch button ("Twitter Bootstrap" ButtonGroup)
 *
 * ~~~
 * echo CookieButton::widget([
 *     'label' => ['On', 'Off'],            // String for default button, array for switch buttons
 *     'toggleClass' => 'btn-primary',      // Only needed if button type is switch
 *     'options' => [
 *          'id' => 'cookieSwitchBtn',      // The button id
 *          'class' => 'btn-xs'             // Default button class
 *     ],
 *     'cookie' => [
 *          'name' => 'name',
 *          'value' => 'value',
 *          'options' => [                  // 'options' are optional
 *              'expires' => 365,           // Define lifetime of the cookie. Value can be a Number which will be interpreted as days from time of creation or a Date object. If omitted, the cookie becomes a session cookie.
 *              'path' => '/',              // Define the path where the cookie is valid. By default the path of the cookie is the path of the page where the cookie was created (standard browser behavior).
 *              'domain' => 'example.com',  // Define the domain where the cookie is valid. Default: domain of page where the cookie was created.
 *              'secure' => true            // If true, the cookie transmission requires a secure protocol (https). Default: false.
 *          ]
 *      ]
 * ]);
 * ~~~
 *
 * @see http://getbootstrap.com/javascript/#buttons
 * @see http://getbootstrap.com/components/#btn-groups
 * @author Marc Mautz <marc@diemeisterei.de>
 * @since 2.0
 */

class CookieButton extends \yii\bootstrap\Widget
{
    /**
     * @var string|array the button label/s
     */
    public $label = 'Button';

    /**
     * @var boolean whether the label should be HTML-encoded.
     */
    public $encodeLabel = true;

    /**
     * @var string the switch button active state CSS class.
     */
    public $toggleClass = '';

    /**
     * @var array the configuration of the cookie.
     *
     */
    public $cookie = [
        'name' => 'name',
        'value' => 'value',
        'options' => [
            'expires' => '',
            'path' => '',
            'domain' => '',
            'secure' => ''
        ]
    ];

    /**
     * @var string the button type setting (i.e. button or switch).
     */
    private $toggleTyp = 'button';

    /**
     * @var string json encoded button and cookie params
     */
    private $params;

    /**
     * Initializes the widget.
     */
    public function init()
    {
        parent::init();

    }

    /**
     * Renders the widget.
     */
    public function run()
    {
        $this->toggleTyp = is_array($this->label) ? 'switch' : 'button';
        switch($this->toggleTyp) {
            case 'button':
                $this->renderButton();
                break;
            case 'switch':
                $this->renderButtonGroup();
                break;
        }

        CookieButtonAsset::register($this->view);
        $this->getView()->registerJs("CookieButton.init('".$this->params."');", View::POS_READY);
    }

    /**
     * Renders the toggle button.
     */
    private function renderButton()
    {
        $this->params = Json::encode([
            'btnName' => $this->options['id'],
            'cookieName' => $this->cookie['name'],
            'cookieValue' => addslashes($this->getHashedCookieValue($this->cookie['value'])),
            'cookieOptions' => isset($this->cookie['options']) ? $this->cookie['options'] : null
        ]);

        if($this->cookie($this->cookie['name'])) {
            Html::addCssClass($this->options, 'active');
        }

        echo Button::widget([
            'label' => $this->encodeLabel ? Html::encode($this->label) : $this->label,
            'options' => ArrayHelper::merge(['data-toggle' => 'button'], $this->options),
        ]);
    }

    /**
     * Renders the button group.
     */
    private function renderButtonGroup()
    {
        $this->params = Json::encode([
            'btnName' => $this->options['id'],
            'cookieName' => $this->cookie['name'],
            'cookieValue' => addslashes($this->getHashedCookieValue($this->cookie['value'])),
            'cookieOptions' => isset($this->cookie['options']) ? $this->cookie['options'] : null,
            'toggleClass' => isset($this->toggleClass) ? $this->toggleClass : null
        ]);

        if($this->cookie($this->cookie['name'])) {
            $isActive = true;
        } else {
            $isActive = false;
        }

        echo ButtonGroup::widget([
            'id' => $this->options['id'],
            'buttons' => [
                [
                    'label' => $this->encodeLabel ? Html::encode($this->label[0]) : $this->label[0],
                    'options' => [
                        'class' => 'btn ' . ($isActive ? $this->toggleClass : 'btn-default') . ' ' . $this->options['class'] . ($isActive ? ' active' : '')
                    ]
                ],
                [
                    'label' => $this->encodeLabel ? Html::encode($this->label[1]) : $this->label[1],
                    'options' => [
                        'class' => 'btn ' . ($isActive ? 'btn-default' : $this->toggleClass) . ' '  . $this->options['class'] . ($isActive ? ' active' : '')
                    ]
                ],
            ]
        ]);
    }

    /*
     * Generate hashed cookie value
     * @param string $value the raw cookie value
     * @return string hashed cookie value
     */
    private function getHashedCookieValue($value)
    {
        $request = \Yii::$app->getRequest();
        $validationKey = $request->cookieValidationKey;
        return \Yii::$app->getSecurity()->hashData(serialize($value), $validationKey);
    }

    /**
     * Remove or return cookie value
     * @todo add cookie...
     * @param string $name the name of the cookie
     * @param string $value the cookie value, if false remove cookie, if null return value
     * @param number $expire the cookie expire date
     * @return string cookie value
     */
    private function cookie($name, $value = null, $expire = 0, $domain = '', $path = '/', $secure = false)
    {
        if($value === false) {
            \Yii::$app->response->cookies->remove($name);
        } elseif($value === null) {
            return \Yii::$app->request->cookies->getValue($name);
        }

        /*$options['name'] = $name;
        $options['value'] = $value;
        $options['expire'] = $expire; //$expire?:time()+86400*365
        $options['domain'] = $domain;
        $options['path'] = $path;
        $options['secure'] = $secure;
        $cookie = new \yii\web\Cookie($options);
        \Yii::$app->response->cookies->add($cookie);*/
    }
} 