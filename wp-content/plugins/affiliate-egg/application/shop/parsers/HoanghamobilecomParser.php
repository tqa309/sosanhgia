<?php

namespace Keywordrush\AffiliateEgg;

defined('\ABSPATH') || exit;

/**
 * TikivnParser class file
 *
 * @author keywordrush.com <support@keywordrush.com>
 * @link http://www.keywordrush.com/
 * @copyright Copyright &copy; 2018 keywordrush.com
 */
class HoanghamobilecomParser extends ShopParser {

    protected $charset = 'utf-8';
    protected $currency = 'VND';

    public function parseCatalog($max)
    {
        $path = array(
            ".//a[@class='title']/@href"
        );

        $urls = $this->xpathArray($path);

        return $urls;
    }

    public function parseTitle()
    {
        return $this->xpathScalar(".//h1");
    }

    public function parsePrice()
    {
        $price = 0;
        $price = $this->xpathScalar(".//*[@class='price current-product-price']//strong"); 

        return $price;
    }

    public function parseOldPrice()
    {
        $price = 0;
        $price = $this->xpathScalar(".//*[@class='price current-product-price']//strike"); 
        
        return $price;
    }


    public function parseImg()
    {
        return 'https://hoanghamobile.com' . $this->xpathScalar(".//*[@data-u='image']/@src");
    }

    public function isInStock()
    {
        return true;
    }

}
