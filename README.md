Yii 2 Cookie Button
==================

Yii 2 Cookie Button based on "Twitter Bootstrap" Button or ButtonGroup.
Widget to store 0/1 in a cookie for Yii2 Framework.  
Add and remove cookies via javascript, with help of [carhartl / jquery-cookie plugin](https://github.com/carhartl/jquery-cookie).

Usage
-----

### Single button (default)

        $button = CookieButton::widget([
            'label' => FA::icon(FA::_EYE),
            'encodeLabel' => false,
            'toggleClass' => 'btn-primary',
            'cookieName' => 'Key-or-Name',
            'cookieValue' => 'on',
            'cookieOptions' => [
                'path' => '/',
                'http' => true,
                'expires' => strtotime('1 week')
            ],
            'options' => [
                'class' => 'btn-primary',
            ]
        ]);

### Switch button

    echo CookieButton::widget([
        'label' => ['On', 'Off'],           // String for default button, array for switch button
        'toggleClass' => 'btn-primary',     // Only needed if button type is switch
        'cookieName' => 'Key-or-Name',
        'cookieValue' => 'on',
        'options' => [
            'id' => 'cookieSwitchBtn',      // The button id
            'class' => 'btn-xs'             // Default button class
        ],
        'cookieOptions' => [
            'options' => [                  // 'options' are optional
                'expires' => 365,           // Define lifetime of the cookie.
                                            // Value can be a Number which will be interpreted as days
                                            // from time of creation or a Date object.
                                            // If omitted, the cookie becomes a session cookie.
                'path' => '/',              // Define the path where the cookie is valid.
                                            // By default the path of the cookie is the path of the page
                                            //where the cookie was created
                                            //(standard browser behavior).
                'domain' => 'example.com',  // Define the domain where the cookie is valid.
                                            // Default: domain of page where the cookie was created.
                'secure' => true            // If true, the cookie transmission requires a secure protocol (https).
                                            // Default: false.
            ]
        ]
    ]);


Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Add repository url to the required section of your `composer.json` file.

    "repositories": [
        {
            "type": "git",
            "url": "https://github.com/dmstr/yii2-cookie-button.git"
        }
    ],

Either run

    php composer.phar require dmstr/yii2-cookie-button "*"

or add

    "dmstr/yii2-cookie-button": "*"


to the required section of your `composer.json` file.
