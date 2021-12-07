<?php

namespace Keywordrush\AffiliateEgg;

defined('\ABSPATH') || exit;

class ShopeevnParser extends ShopParser {

    protected $charset = 'utf-8';
    protected $currency = 'VND';
    protected $headers;
    protected $_queryString;
    protected $_product;

    public function parseCatalog($max)
    {
        $html = $this->dom->saveHTML();
        if (preg_match_all('/"item_basic":{"itemid":(\d+?),"shopid":(\d+?),"name":"(.+?)"/', $html, $matches)) {
            $urls = array();
            foreach ($matches[2] as $i => $shopId)
            {
                $name = preg_replace('/[\[\]\%]/', '', $matches[3][$i]);
                $name = str_replace(' ', '-', $name);
                $name = html_entity_decode($name);
                $urls[$i] = 'https://shopee.vn/' . $name . '-i.' . $matches[2][$i] . '.' . $matches[1][$i] ;
            }
            return $urls;
        }
    }

    public function parseTitle()
    {
        $this->_getProduct();
        return $this->_product['item']['name'];
        return 'a';
    }

    public function _priceTrim($price) {
        $price = str_replace('₫', '', $price);
        $price = str_replace('.', '', $price);
        $price = str_replace(' ', '', $price);
        return $price;
    }

    public function parsePrice()
    {
        return substr($this->_product['item']['price_min'], 0, -5);
    }

    public function parseOldPrice()
    {
        
        if (isset($this->_product['item']['price_min_before_discount']))
            return substr($this->_product['item']['price_min_before_discount'], 0, -5);
    }

    public function parseImg()
    {
        $img = 'https://cf.shopee.vn/file/' . $this->_product['item']['images'][0];
        return $img;
    }

    private function _getProduct()
    {
        if (!preg_match('/-i.(\d+?)\.(\d+)/', $this->getUrl(), $matches))
            return false;

        $uri = 'https://shopee.vn/api/v2/item/get?itemid='. $matches[2] .'&shopid=' . $matches[1];
        $queryString = 'itemid='. $matches[2] .'&shopid=' . $matches[1];
        $match = md5('55b03'. md5($queryString) .'55b03');
        $match = '55b03-' . $match;
        $this->headers = array(
            'accept' => '*/*',
            'accept-encoding' => 'gzip, deflate, br',
            'accept-language' => 'vi,en-US;q=0.9,en;q=0.8',
            'cookie' => 'SPC_IA=-1; SPC_F=SMXFfazQOfG5ovO9Ee2SCsgr6fQL8heB; REC_T_ID=6dbfba96-83c0-11eb-b65e-3c15fb7e9f43; _fbp=fb.1.1615614806799.1835216716; _hjid=22c76d90-ce69-4c29-a2ab-c0c66ad27379; G_ENABLED_IDPS=google; SPC_CLIENTID=U01YRmZhelFPZkc1ptjscogahdjsgbtu; _fbc=fb.1.1620550137461.IwAR0HN4whqSh7gKNgXYwf9OnHPDA-G9N-iJeqiUmvLSDfzatsiMaOKiwI3uI; SPC_EC=-; SPC_U=-; _gcl_aw=GCL.1622959387.Cj0KCQjwweyFBhDvARIsAA67M70sCk6KIbP-PooL1LzW5DftcLu8vCm20M1MygcwUXI3zcJZm85qq7oaAlKPEALw_wcB; _gac_UA-61914164-6=1.1622959390.Cj0KCQjwweyFBhDvARIsAA67M70sCk6KIbP-PooL1LzW5DftcLu8vCm20M1MygcwUXI3zcJZm85qq7oaAlKPEALw_wcB; SPC_SI=mall.RDtpJrjxjrWntpKmmizL4FuoTZh0CIwa; _gcl_au=1.1.1327883715.1623501378; _gid=GA1.2.867413305.1623501380; SPC_PC_HYBRID_ID=75; csrftoken=Fp2BLLKbEZ8KQMGOa6bD2ms1vrasSBSO; SC_DFP=PP0csXBtnbMmO3cdnokbHl9U5kcpO6Dw; SPC_SC_UD=; UYOMAPJWEMDGJ=; SPC_IVS=; SPC_SC_TK=; _med=refer; AMP_TOKEN=%24NOT_FOUND; SPC_R_T_ID="FnuBZQMDTip3m05b0pQzPihA5fiCCxYVYF0EKbeHrWMvxUGFa1p3sdEQLgxN9kLz8cfKcVhWGYtX5OZGCjMQ8ucuInPM3Eq9JsVqpP+gcK0="; SPC_T_IV="HOLnkYa2z3oC/mdbtGWZoA=="; SPC_R_T_IV="HOLnkYa2z3oC/mdbtGWZoA=="; SPC_T_ID="FnuBZQMDTip3m05b0pQzPihA5fiCCxYVYF0EKbeHrWMvxUGFa1p3sdEQLgxN9kLz8cfKcVhWGYtX5OZGCjMQ8ucuInPM3Eq9JsVqpP+gcK0="; _ga=GA1.2.2019702015.1615614808; _ga_M32T05RVZT=GS1.1.1623519787.90.1.1623522480.60',
            'dnt' => '1',
            'if-none-match-' => $match,
            'referer' => 'https://shopee.vn/%C4%90i%E1%BB%87n-Tho%E1%BA%A1i-Iphone-8-Qu%C3%B4%CC%81c-T%C3%AA%CC%81-Ha%CC%80ng-Chi%CC%81nh-Ha%CC%83ng-i.188863065.6833872841',
            'sec-ch-ua' => '" Not;A Brand";v="99", "Google Chrome";v="91", "Chromium";v="91"',
            'sec-ch-ua-mobile' => '?0',
            'sec-fetch-dest' => 'empty',
            'sec-fetch-mode' => 'cors',
            'sec-fetch-site' => 'same-origin',
            'user-agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.77 Safari/537.36',
            'x-api-source' => 'pc',
            'x-requested-with' => 'XMLHttpRequest',
            'x-shopee-language' => 'vi',
        );
        $json = $this->getRemoteJson($uri);
        $this->_product = $json;
    }
}
