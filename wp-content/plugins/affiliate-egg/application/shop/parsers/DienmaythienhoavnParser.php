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
class DienmaythienhoavnParser extends ShopParser {

    protected $charset = 'utf-8';
    protected $currency = 'VND';

    public function parseCatalog($max)
    {
        $path = array(
            ".//*[@class='col-md-4']//div//a[@class='link-img']/@href"
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
        $price = $this->xpathScalar(".//*[contains(@class, 'price-real')]"); 

        return $price;
    }

    public function parseOldPrice()
    {
        $price = 0;
        $price = $this->xpathScalar(".//*[@class='price-sale']"); 
        
        return $price;
    }


    public function parseImg()
    {
        return $this->xpathScalar(".//*[@class='bzoom_big_image']/@src");
    }

    public function isInStock()
    {
        return true;
    }

}
