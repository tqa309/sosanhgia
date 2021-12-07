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
class HnammobilecomParser extends ShopParser {

    protected $charset = 'utf-8';
    protected $currency = 'VND';

    public function parseCatalog($max)
    {
        $path = array(
            ".//h3[@class='product-name']//a/@href"
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
        $price = $this->xpathScalar(".//*[@class='price']"); 

        return $price;
    }

    public function parseOldPrice()
    {
        $price = 0;
        $price = $this->xpathScalar(".//*[@class='price-base']"); 
        
        return $price;
    }


    public function parseImg()
    {
        return $this->xpathScalar(".//*[@class='image-wrapper']//picture//img/@data-src");
    }

    public function isInStock()
    {
        return true;
    }

}
