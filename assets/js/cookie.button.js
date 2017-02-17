/**
 * @link http://diemeisterei.de
 * @copyright Copyright (c) 2014 diemeisterei GmbH
 * @license https://github.com/dmstr/yii2-cookie-button/LICENSE.md
 * @author Marc Mautz <marc@diemeisterei.de>
 */
var CookieButton = (function () {
    'use strict';

    /**
     * register the click event to the button
     * @param object options
     * @see init()
     * @private
     */
    function _registerEventListener(options) {
        $('#' + options.btnName).on('click', function(event) {
            if(!$.cookie(options.cookieName)) {
                $.cookie(options.cookieName, options.cookieValue, options.cookieOptions);
            } else {
                $.removeCookie(options.cookieName, options.cookieOptions);
            }
            if(options.toggleClass && $(this).find('.' + options.toggleClass).length) {
                $(this).find('.btn').toggleClass('active');
                $(this).find('.btn').toggleClass(options.toggleClass);
                $(this).find('.btn').toggleClass('btn-default');
            }
            $(document).trigger('cookieUpdate');
        });
    }

    return {
        /**
         * initialised the button and register the event listener
         * @param json string params, containing the following elements:
         * string btnName, string cookieName, string cookieValue, object cookieOptions, string toggleClass
         * @public
         */
        init: function(params) {
            var options = JSON.parse(params);
            _registerEventListener(options);
        }
    }
}());
