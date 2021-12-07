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
class NguyenkimcomParser extends ShopParser {

    protected $charset = 'utf-8';
    protected $currency = 'VND';

    public function parseCatalog($max)
    {
        $path = array(
            ".//*[@class='product-card-link nk-product-link']/@href"
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
        $price = $this->xpathScalar(".//*[@class='nk-price-final']"); 

        return $price;
    }

    public function parseOldPrice()
    {
        $price = 0;
        $price = $this->xpathScalar(".//*[@class='product_info_price_value-real']"); 
        
        return $price;
    }


    public function parseImg()
    {
        return $this->xpathScalar(".//*[@class='wrap-img-tag-pdp']//img[@class='img-full-width ']/@src");
    }

    public function isInStock()
    {
        return true;
    }

}
