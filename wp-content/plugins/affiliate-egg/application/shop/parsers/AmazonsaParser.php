<?php

namespace Keywordrush\AffiliateEgg;

defined('\ABSPATH') || exit;

/**
 * AmazonsaParser class file
 *
 * @author keywordrush.com <support@keywordrush.com>
 * @link https://www.keywordrush.com
 * @copyright Copyright &copy; 2020 keywordrush.com
 */
require_once dirname(__FILE__) . '/AmazoncomParser.php';

class AmazonsaParser extends AmazoncomParser {

    protected $canonical_domain = 'https://www.amazon.sa';
    protected $currency = 'SAR';

}
