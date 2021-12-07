<?php

namespace Keywordrush\AffiliateEgg;

defined('\ABSPATH') || exit;

class ShopsamsungcomParser extends ShopParser {

    protected $charset = 'utf-8';
    protected $currency = 'VND';
    protected $headers;
    protected $_queryString;
    protected $_catalog;
    protected $_product;

    public function parseCatalog($max)
    {
        $html = $this->dom->saveHTML();
        $modelNames = array();
        if (preg_match_all('/"modelCode":"(.+?)","modelName":"(.+?)"/', $html, $matches)) {
            $urls = array();
            foreach ($matches[1] as $i => $modelCode)
            {
                if (!in_array($matches[2][$i],$modelNames)) {
                    $urls[$i] = 'https://shop.samsung.com/vn/00/G1/product/p/' . $modelCode;
                }
                    
            }
            return $urls;
        }
    }

    public function parseTitle()
    {
        $this->_getProduct();
        if (!preg_match('/\/p\/(.+)/', $this->getUrl(), $matches))
            return false;
        
        return $this->_product['displayName'] . ' ' . $matches[1];
    }

    public function parsePrice()
    {
        return substr($this->_product['priceDisplay'], 0, -5);
    }

    public function parseOldPrice()
    {        
        if (strcmp($this->_product['afterTaxPriceDisplay'], $this->_product['priceDisplay']) != 0)
            return substr($this->_product['afterTaxPriceDisplay'], 0, -5);
    }

    public function parseImg()
    {
        return $this->_product['thumbUrl'];
    }

    public function isInStock()
    {
        if (!$this->_product['priceDisplay']) return false;
        return true;
    }

    private function _getProduct()
    {
        if (!preg_match('/\/p\/(.+)/', $this->getUrl(), $matches))
            return false;

        $uri = 'https://searchapi.samsung.com/v6/front/b2c/product/card/detail/global?siteCode=vn&modelList='. $matches[1] .'&saleSkuYN=N&onlyRequestSkuYN=N&keySummaryYN=N&specYN=N';
        
        $json = $this->getRemoteJson($uri);
        $this->_product = $json['response']['resultData']['productList']['0']['modelList']['0'];
        if (!$this->_product['priceDisplay']) {
            $this->_product = $json['response']['resultData']['productList']['0']['modelList']['1'];
        }
        if (!$this->_product['priceDisplay']) {
            $this->_product = $json['response']['resultData']['productList']['0']['modelList']['2'];
        }
        if (!$this->_product['priceDisplay']) {
            $this->_product = $json['response']['resultData']['productList']['0']['modelList']['3'];
        }
        if (!$this->_product['priceDisplay']) {
            $this->_product = $json['response']['resultData']['productList']['0']['modelList']['4'];
        }
        if (!$this->_product['priceDisplay']) {
            $this->_product = $json['response']['resultData']['productList']['0']['modelList']['5'];
        }

        $this->setNewUrl('https://www.samsung.com' . $this->_product['pdpUrl']);
    }
}
